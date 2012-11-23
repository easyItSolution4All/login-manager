var Clients = {
	ListController: function($scope, Client) {
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
	},
	CreateController: function($scope, $location, Client) {
		$scope.client = new Client;
		$scope.action = 'CREATE';
		$scope.saveClient = function(scope) {
			saveClient(scope, $location);
		};
	},
	EditController: function($scope, $location, $routeParams, Client) {
		$scope.client = Client.get({ id: $routeParams.clientId });
		$scope.action = 'EDIT';
		$scope.saveClient = function(scope) {
			saveClient(scope, $location);
		};
	}
}

function saveClient(scope, $location) {
	var result = scope.client.$save({}, 
		function() {
			$location.path('/clients');
		},
		function() {
			console.log('nup');
		}
	);
}