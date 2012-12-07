var Services = angular.module('Services', ['ngResource']);

Services.factory('Client', ['$resource', function($resource) {
	return $resource('/clients/:id', {id: '@id'}, {
	  destroy: { method: 'DELETE' }
  });
}]);

Services.factory('Project', ['$resource', function($resource) {
	return $resource('/projects/:id', {id: '@id'}, {
	  destroy: { method: 'DELETE' }
  });
}]);

Services.factory('Login', ['$resource', function($resource) {
	return $resource('/logins/:id', {id: '@id'}, {
	  destroy: { method: 'DELETE' },
	  access: { method: 'POST', params: { action: 'access' } }
  });
}]);

Services.factory('Favourite', ['$resource', function($resource) {
	return $resource('/favourites/:id', {id: '@id'}, {
	  destroy: { method: 'DELETE' }
  });
}]);

Services.factory('User', ['$resource', function($resource) {
	return $resource('/users/:id', {id: '@id'}, {
	  destroy: { method: 'DELETE' }
  });
}]);

// User profile resource
Services.factory('Profile', ['$resource', function($resource) {
	return $resource('/users/profile', {}, {
	  destroy: { method: 'DELETE' }
  });
}]);
