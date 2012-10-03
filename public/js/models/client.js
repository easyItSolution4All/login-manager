App.factory('Client', ['$resource', function($resource) {
	return $resource('/clients/:id', { id: '@id' });
}]);
