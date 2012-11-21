var Clients = {
	ListController: function($scope, Client) {
		$scope.delete = function(event) {
			event.stopPropagation();
			event.preventDefault();
			
			Client.delete({id: this.client.id});
			
			return false;
		};

		$scope.clients = Client.query();
	},
	CreateController: function($scope, $location, Client) {
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
	}
}

