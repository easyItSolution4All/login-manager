var Services = angular.module('Services', ['ngResource']);

Services.factory('Client', ['$resource', function($resource) {
	return $resource('/clients/:id', {id: '@id'}, {
	  create: { method: 'POST' },
	  destroy: { method: 'DELETE' }
  });
}]);

Services.factory('Project', ['$resource', function($resource) {
	return $resource('/projects/:id', {id: '@id'}, {
	  create: { method: 'POST' },
	  destroy: { method: 'DELETE' }
  });
}]);

Services.factory('Login', ['$resource', function($resource) {
	return $resource('/logins/:id', {id: '@id'}, {
	  create: { method: 'POST' },
	  destroy: { method: 'DELETE' }
  });
}]);
