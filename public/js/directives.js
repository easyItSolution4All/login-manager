var directives = angular.module('Directives', []);

directives.directive('lmMenu', ['$location', function($location) {
	return {
		templateUrl: '/templates/menu.html',
		link: function(scope, iElement, iAttrs) {
			scope.$on("$routeChangeSuccess", function(event) {
				for (var i = 0; i < scope.menu.length; i++) {
					// deactivate
					if (scope.menu[i].active) delete scope.menu[i].active
					var regex = new RegExp('^' + scope.menu[i].href);

					// make active
					if (scope.menu[0].href == $location.$$url) scope.menu[0].active = true;
					else if (regex.test($location.$$url) && scope.menu[i].href != '/') scope.menu[i].active = true;
				}
			});

			scope.menu = [
				{text: 'LOGINS', href: '/'},
				{text: 'PROJECTS', href: '/projects'},
				{text: 'CLIENTS', href: '/clients'}
			];
		}
	};
}]);