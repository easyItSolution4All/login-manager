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
		var phrase = l.project_id + l.name;
		var pass = CryptoJS.AES.decrypt(angular.fromJson(l.password), phrase).toString(CryptoJS.enc.Utf8);

		var clip = new ZeroClipboard.Client();

		clip.setText(pass);
		clip.setHandCursor(true);
		clip.glue('loginPass' + l.id);

		// let the server know someone accessed the password
		clip.addEventListener('onComplete', function() {
			$http.post('/logins/access/', { id: l.id });
		});
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

	$scope.saveLogin = function(scope) {
		_saveLogin(scope, $location);
	};
	$scope.ifMysql = function() {
		return $scope.login.type == 'mysql';
	}
}

function LoginsEditCtrl($scope, $rootScope, $location, $routeParams, Login, Project) {
	$scope.login = Login.get({id: $routeParams.loginId}, function(data) {
		data.password = '';
	});
	
	$scope.action = 'EDIT';
	$scope.types = $rootScope.loginTypes;
	$scope.projects = Project.query();
	$scope.logins = Login.query();

	$scope.saveLogin = function(scope) {
		_saveLogin(scope, $location);
	};
	$scope.ifMysql = function() {
		return $scope.login.type == 'mysql';
	}
}

function _saveLogin(scope, $location) {
	var phrase = scope.login.project_id + scope.login.name;
	scope.login.password = (scope.login.password) ?  CryptoJS.AES.encrypt(scope.login.password, phrase) : '';
	
	var result = scope.login.$save({},
		function() {
			$location.path('/logins');
		},
		function() {
			console.log('nup');
		}
	);
}