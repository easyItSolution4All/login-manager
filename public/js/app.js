var App = angular.module('Login Manager', ['ngResource', 'Services', 'Directives']);

App.config(
	['$locationProvider', function($location) {
		$location.html5Mode(true); //now there won't be a hashbang within URLs for browers that support HTML5 history
	}]
);
App.config(
	['$routeProvider', function($routes) {
		$routes.when('/', {
			templateUrl: '/templates/logins.html',
			controller: Logins.ListController
		});
		$routes.when('/logins/create', {
			templateUrl: '/templates/logins/create.html',
			controller: Logins.CreateController
		});
		$routes.when('/clients/create', {
			templateUrl: '/templates/clients/form.html',
			controller: Clients.CreateController
		});
		$routes.when('/clients', {
			templateUrl: '/templates/clients.html',
			controller: Clients.ListController
		});
		$routes.when('/clients/edit/:clientId', {
			templateUrl: '/templates/clients/form.html',
			controller: Clients.EditController
		});
		$routes.when('/404', {
			templateUrl: '/templates/404.html'
		});
		$routes.otherwise({
			redirectTo: '/404'
		});
	}]
);
