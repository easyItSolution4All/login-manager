function LoginsListCtrl($scope, $rootScope, $http, Login) {
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
		var phrase = this.login.project_id + this.login.name;
		var pass = CryptoJS.AES.decrypt(angular.fromJson(this.login.password), phrase).toString(CryptoJS.enc.Utf8);

		var clip = new ZeroClipboard.Client();

		clip.setText(pass);
		clip.setHandCursor(true);
		clip.glue('loginPass' + this.login.id);
	};

	$scope.selectClient = function() {
		event.stopPropagation();
		event.preventDefault();

		if (this.login)
			$scope.clientId = this.login.project.client_id;
		else
			$scope.clientId = null;
	};
	
	$scope.clientId = null;
	$scope.logins = Login.query();
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
	scope.login.password = CryptoJS.AES.encrypt(scope.login.password, phrase);
	
	var result = scope.login.$save({}, 
		function() {
			$location.path('/logins');
		},
		function() {
			console.log('nup');
		}
	);
}