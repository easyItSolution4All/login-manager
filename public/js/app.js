var App = angular.module('Login Manager', ['ngResource', 'ngCookies', 'Services', 'Directives', 'Filters']);

App.config(
	['$locationProvider', function($location) {
		$location.html5Mode(true); //now there won't be a hashbang within URLs for browers that support HTML5 history
	}]
);
App.config(
	['$routeProvider', function($routes) {
		// $routes.when('/', {
		// 	templateUrl: '/templates/home.html',
		// 	controller: HomeCtrl
		// });

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

		$routes.when('/profile', {
			controller: UserProfileCtrl,
			templateUrl: '/templates/profile.html'
		});

		$routes.when('/help', {
			controller: HelpCtrl,
			templateUrl: '/templates/help.html'
		});
		$routes.when('/404', {
			templateUrl: '/templates/404.html'
		});
		$routes.otherwise({
			redirectTo: '/logins'
		});
	}]
);

App.config(function($httpProvider) {
	var interceptor = ['$rootScope','$q', function(scope, $q) {
		function success(response) {
			return response;
		}

		function error(response) {
			var status = response.status;

			if (status == 401) {
				var deferred = $q.defer();
				var req = {
					config: response.config,
					deferred: deferred
				}
				scope.requests401.push(req);
				scope.$broadcast('event:loginRequired');

				return deferred.promise;
			}

			// otherwise
			return $q.reject(response);
		}
	 
		return function(promise) {
			return promise.then(success, error);
		};
	 
	}];

	$httpProvider.responseInterceptors.push(interceptor);
});

App.run(function($rootScope, $routeParams, $location, $http){
	$rootScope.loginTypes = [
		{value: 'cms', text: 'CMS'},
		{value: 'ftp', text: 'FTP'},
		{value: 'ssh', text: 'SSH'},
		{value: 'mysql', text: 'MySQL'},
		{value: 'panel', text: 'Server Control Panel'},
		{value: 'service', text: 'Third-Party Service'}
	];
	
	$rootScope.user = {};
	$rootScope.user.favourites = [];
	$rootScope.params = $routeParams;

	// Simple, small method we use a lot just to go to other locations in the app
	$rootScope.go = function(url) {
		$location.path(url);
	};

	/**
	 * Holds all the requests which failed due to 401 response.
	 */
	$rootScope.requests401 = [];

	/**
	 * On 'event:loginConfirmed', resend all the 401 requests.
	 */
	$rootScope.$on('event:loginConfirmed', function() {
		var i, requests = $rootScope.requests401;

		for (i = 0; i < requests.length; i++) {
			retry(requests[i]);
		}

		$rootScope.requests401 = [];

		function retry(req) {
			$http(req.config).then(function(response) {
				req.deferred.resolve(response);
			});
		}
	});

	/**
	* On 'logoutRequest' invoke logout on the server and broadcast 'event:loginRequired'.
	*/
	$rootScope.$on('event:logoutRequest', function() {
		$http.delete('/sessions', {}).success(function() {
			ping();
		});
	});

	/**
	* Ping server to figure out if user is already logged in.
	*/
	function ping() {
		$http.get('/sessions').success(function(data) {
			$rootScope.user = data;
			$rootScope.$broadcast('event:loginConfirmed');
		});
	}

	ping();
});
