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

/**
 * Sets the protocol necessary when dealing with the login "type"
 * For example, if login type is cms, then protocol will be http://. If
 * the login type is ftp, it would be ftp://, as an example.
 */
Filters.filter('setProtocol', function() {
	return function(input) {
		var protocol = '';

		if (input == 'cms' || input == 'panel' || input == 'service')
			protocol = 'http://';
		if (input == 'ssh')
			protocol = 'ssh://';
		if (input == 'mysql')
			protocol = 'mysql://';
		if (input == 'ftp')
			protocol = 'ftp://';

		return protocol + ' ';
	};
});

Filters.filter('properTypeCase', function($rootScope) {
	return function(input) {
		for (var i = 0; i < $rootScope.loginTypes.length; i++) {
			if ($rootScope.loginTypes[i].value == input) return $rootScope.loginTypes[i].text;
		}
	};
});

Filters.filter('usableLocation', function() {
	return function(input) {
		if (this.login.type == 'cms' || this.login.type == 'panel' || this.login.type == 'service') {
			var location = 'http://' + input;
			return '<a href="' + location + '" target="_blank">' + input + '</a>';
		}

		return input;
	};
});
