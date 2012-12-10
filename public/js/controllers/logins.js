function LoginsListCtrl($scope, $rootScope, $http, Login, Client) {
	$scope.delete = function(event) {
		event.stopPropagation();
		event.preventDefault();

		var response = confirm('Are you sure you want to remove this item?');
		
		if (response) {
			$scope.logins.splice(this.$index, 1);
			this.login.$destroy();
		}
	};

	$scope.setPass = function() {
		var l = this.login;

		// Only instantiate a ZeroClipboard client if one hasn't already been instantiated
		if (!l.clip && l.password) {
			var phrase = l.project_id + l.name;

			var pass = CryptoJS.AES.decrypt(angular.fromJson(l.password), phrase).toString(CryptoJS.enc.Utf8);
			
			l.clip = new ZeroClipboard.Client();
			
			l.clip.setText(pass);
			l.clip.setHandCursor(true);
			l.clip.glue('loginPass' + l.id);

			// let the server know someone accessed the password
			l.clip.addEventListener('onComplete', function() {
				$http.post('/logins/access/', { id: l.id });
			});
		}
	};

	$scope.reset = function() {
		$scope.client = null;
		$scope.type = null;
		$scope.favourites = '';
	}

	$scope.logins = Login.query();
	$scope.types = $rootScope.loginTypes;
	$scope.clients = Client.query();
	$scope.reset();
}

function LoginsCreateCtrl($scope, $rootScope, $location, Login, Project) {
	$scope.login = new Login;
	$scope.login.port = 3306; // default port value
	$scope.action = 'CREATE';
	$scope.types = $rootScope.loginTypes;
	$scope.projects = Project.query();
	$scope.logins = Login.query();
	$scope.activeTab = 'details';

	$scope.saveLogin = function(scope) {
		_saveLogin(scope, $location);
	};
	$scope.ifMysql = function() {
		return $scope.login.type == 'mysql';
	}
}

function LoginsEditCtrl($scope, $rootScope, $location, $http, $routeParams, Login, Project) {
	$scope.login = Login.get({id: $routeParams.loginId}, function(data) {
		data.password = '';
	});
	
	$scope.activeTab = 'details';
	$scope.action = 'EDIT';
	$scope.types = $rootScope.loginTypes;
	$scope.projects = Project.query();
	$scope.logins = Login.query();

	$scope.setTab = function(tab) {
		$scope.activeTab = tab;
	}
	$scope.saveLogin = function(scope) {
		_saveLogin(scope, $location);
	};
	$scope.ifMysql = function() {
		return $scope.login.type == 'mysql';
	};
	$scope.deleteVersion = function(event) {
		event.stopPropagation();
		event.preventDefault();

		var response = confirm('Are you sure you want to remove this item?');
		
		if (response) {
			$scope.login.versions.splice(this.$index, 1);
			$http.delete('/versions/' + this.v.id, {});
		}
	};
	$scope.revert = function(event) {
		event.stopPropagation();
		event.preventDefault();

		var response = confirm('Are you sure you want to revert the login to this version?');
		
		if (response) {
			$http.post('/versions/revert/' + this.v.id, {});
		}
	};
}

function _saveLogin(scope, $location) {
	var phrase = scope.login.project_id + scope.login.name;
	scope.login.password = (scope.login.password) ?  CryptoJS.AES.encrypt(scope.login.password, phrase) : '';
	
	// clean up the object before saving
	if (scope.login.versions) delete scope.login.versions;
	if (scope.login.accesses) delete scope.login.accesses;
	if (scope.login.logs) delete scope.login.logs;

	var result = scope.login.$save({},
		function() {
			$location.path('/logins');
		},
		function() {
			console.log('nup');
		}
	);
}