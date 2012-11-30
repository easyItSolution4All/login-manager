var App = angular.module('Login Manager', ['ngResource', 'Services', 'Directives', 'Filters']);

App.config(
	['$locationProvider', function($location) {
		$location.html5Mode(true); //now there won't be a hashbang within URLs for browers that support HTML5 history
	}]
);
App.config(
	['$routeProvider', function($routes) {
		$routes.when('/', {
			templateUrl: '/templates/home.html',
		});

		$routes.when('/clients/create', {
			templateUrl: '/templates/clients/form.html',
			controller: ClientCreateCtrl
		});
		$routes.when('/clients', {
			templateUrl: '/templates/clients.html',
			controller: ClientListCtrl
		});
		$routes.when('/clients/edit/:clientId', {
			templateUrl: '/templates/clients/form.html',
			controller: ClientEditCtrl
		});
		
		$routes.when('/projects/create', {
			templateUrl: '/templates/projects/form.html',
			controller: ProjectCreateCtrl
		});
		$routes.when('/projects', {
			templateUrl: '/templates/projects.html',
			controller: ProjectListCtrl
		});
		$routes.when('/projects/edit/:projectId', {
			templateUrl: '/templates/projects/form.html',
			controller: ProjectEditCtrl
		});
		
		$routes.when('/logins', {
			templateUrl: '/templates/logins.html',
			controller: LoginsListCtrl
		});
		$routes.when('/logins/create', {
			templateUrl: '/templates/logins/form.html',
			controller: LoginsCreateCtrl
		});
		$routes.when('/logins/edit/:loginId', {
			templateUrl: '/templates/logins/form.html',
			controller: LoginsEditCtrl
		});

		$routes.when('/help', {
			controller: HelpCtrl,
			templateUrl: '/templates/help.html'
		});
		$routes.when('/404', {
			templateUrl: '/templates/404.html'
		});
		$routes.otherwise({
			redirectTo: '/404'
		});
	}]
);

App.run(function($rootScope, $routeParams, $location){
	$rootScope.loginTypes = [
		{value: 'cms', text: 'CMS'},
		{value: 'ftp', text: 'FTP'},
		{value: 'ssh', text: 'SSH'},
		{value: 'mysql', text: 'MySQL'},
		{value: 'panel', text: 'Server Control Panel'},
		{value: 'service', text: 'Third-Party Service'}
	];
	
	$rootScope.params = $routeParams;

	$rootScope.go = function(url) {
		$location.path(url);
	}
});
