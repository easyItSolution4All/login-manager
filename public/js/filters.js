var Filters = angular.module('Filters', []);

/**
 * For the client list on the projects screen - shows unique clients
 * from the projects clist and returns the resulting array.
 */
Filters.filter('clientsOnly', function() {
	return function(input) {
		var clients = [];
		var lastClient = null;

		for (var i = 0; i < input.length; i++) {
			if (input[i].client_id != lastClient) clients.push(input[i]);
		}

		return clients;
	};
});

/**
 * Shows projects based on the selected client
 */
Filters.filter('selectedClient', function() {
	return function(input, clientId) {
		if (clientId == null) return input;

		var clients = [];

		for (var i = 0; i < input.length; i++) {
			if (input[i].client_id == clientId) clients.push(input[i]);
		}
		
		return clients;
	};
});