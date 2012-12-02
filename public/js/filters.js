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
	return function(input, login) {
		if (login.type == 'cms' || login.type == 'panel' || login.type == 'service') {
			var location = 'http://' + input;
			return '<a href="' + location + '" target="_blank">' + input + '</a>';
		}

		return input;
	};
});

/**
 * Shows logins based on selected login type and/or client
 */
Filters.filter('logins', function() {
	return function(input) {
		if (this.client == null && this.type == null && this.favourties == '') return input;

		var requiredNumConditions = 0;

		if (this.client != null) requiredNumConditions++;
		if (this.type != null) requiredNumConditions++;
		if (this.favourites != '') requiredNumConditions++;

		var logins = [];

		for (var i = 0; i < input.length; i++) {
			var conditionsMet = 0;
			
			if (this.client != null && input[i].project.client_id == this.client) conditionsMet++;
			if (this.type != null && input[i].type == this.type) conditionsMet++;
			if (this.favourites != '' && this.favourites == 'true') {
				// loop through favourites and see if this exists
				var favs = this.user.favourites;
				for (var j = 0; j < favs.length; j++) {
					if (favs[j] == input[i].id) {
						conditionsMet++;
					}
				}
			}

			if (this.favourites != '' && this.favourites == 'false') {
				// loop through favourites and see if this exists
				if (this.user.favourites.indexOf(input[i].id) == -1) {
					conditionsMet++;
				}
			}

			if (conditionsMet == requiredNumConditions) logins.push(input[i]);
		}
		
		return logins;
	};
});