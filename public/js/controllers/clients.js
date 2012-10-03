var Clients = {
	ListController: ['$scope', 'Client', function($scope, Client) {
		$scope.clients = Client.query();
	}],
	CreateController: ['$scope', '$location', 'Client', function($scope, $location, Client) {
		$scope.client = new Client;
		
		$scope.submitClient = function() {
			var result = $scope.client.$save({}, 
				function() {
					$location.path('/clients');
				},
				function() {
					console.log('nup');
				}
			);
			
			return false;
		};
	}]
}
