var Services = angular.module('Services', ['ngResource']);

Services.factory('Client', ['$resource', function($resource) {
	return $resource('/clients/:id', {id: '@id'}, {
	  create: { method: 'POST', params: { action: 'create' }},
	  destroy: { method: 'DELETE' }
  });
}]);

Services.factory('Project', ['$resource', function($resource) {
	return $resource('/projects/:action', {action: '@action'}, {
	  create: {method: 'POST', params: { action: 'create' }},
	  destroy: {method: 'DELETE', params: { action: '' }},
	  query: {method: 'GET', isArray: true }
  });
}]);
