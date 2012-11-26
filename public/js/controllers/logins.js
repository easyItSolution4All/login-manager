function LoginsListCtrl($scope, Login) {
	$scope.delete = function(event) {
		event.stopPropagation();
		event.preventDefault();

		var response = confirm('Are you sure you want to remove this item?');
		
		if (response) {
			$scope.logins.splice(this.$index, 1);
			this.login.$destroy();
		}
	};
	
	$scope.logins = Login.query();
}

function LoginsCreateCtrl($scope, Login) {
	$scope.login = new Login;
	$scope.action = 'CREATE';
	$scope.saveLogin = function(scope) {
		_saveLogin(scope, $location);
	};
}

function _saveLogin(scope, $location) {
	var result = scope.login.$save({}, 
		function() {
			$location.path('/logins');
		},
		function() {
			console.log('nup');
		}
	);
}