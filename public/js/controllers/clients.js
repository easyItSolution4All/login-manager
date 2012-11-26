function ClientListCtrl($scope, Client) {
	$scope.delete = function(event) {
		event.stopPropagation();
		event.preventDefault();

		var response = confirm('Are you sure you want to remove this item?');
		
		if (response) {
			$scope.clients.splice(this.$index, 1);
			this.client.$destroy();
		}
	};
	
	$scope.clients = Client.query();
}

function ClientCreateCtrl($scope, $location, Client) {
	$scope.client = new Client;
	$scope.action = 'CREATE';
	$scope.saveClient = function(scope) {
		_saveClient(scope, $location);
	};
}

function ClientEditCtrl($scope, $location, $routeParams, Client) {
	$scope.client = Client.get({ id: $routeParams.clientId });
	$scope.action = 'EDIT';
	$scope.saveClient = function(scope) {
		_saveClient(scope, $location);
	};
}

function _saveClient(scope, $location) {
	var result = scope.client.$save({}, 
		function() {
			$location.path('/clients');
		},
		function() {
			console.log('nup');
		}
	);
}
