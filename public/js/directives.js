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
				{text: 'HOME', href: '/'},
				{text: 'LOGINS', href: '/logins'},
				{text: 'PROJECTS', href: '/projects'},
				{text: 'CLIENTS', href: '/clients'},
				{text: 'ADMIN', href: '/admin'}
			];
		}
	};
}]);

// Manages the login functionality for the application
directives.directive('lmLogin', ['$rootScope', function($rootScope) {
	return {
		restrict: 'E',
		replace: false,
		templateUrl: 'templates/login.html',
		link: function(scope, element, attrs) {
			var timeout= 300;

			scope.submitLogin = function() {
				$.post('/sessions', {email: scope.email, password: scope.password}, function(data) {
					if (data.status == 'success') {
						$rootScope.$broadcast('event:loginConfirmed');
						$('.overlay').fadeOut(timeout);
						$('.login-box').fadeOut(timeout);
					}
				});
			};

			scope.$on('event:loginRequired', function() {
				// handle login functionality
				$('.overlay').show();
				$('.login-box').fadeIn(timeout);
			});
		}
	};
}]);

directives.directive('lmUserPanel', ['$rootScope', function($rootScope) {
	return {
		restrict: 'E',
		replace: true,
		template: '<div class="user" ng-show="user">Logged in as <strong>{{user.name}}</strong> <span class="v_line"> | </span> <a href="/help">Help</a> <span class="v_line"> | </span> <a href="" ng-click="logout()">Logout</a></div>',
		link: function(scope, element, attrs) {
			scope.user = $rootScope.user;
			scope.logout = function() {
				$rootScope.$broadcast('event:logoutRequest');
			};
		}
	};
}]);