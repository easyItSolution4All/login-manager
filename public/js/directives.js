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
				//{text: 'HOME', href: '/'},
				{text: 'LOGINS', href: '/logins'},
				{text: 'PROJECTS', href: '/projects'},
				{text: 'CLIENTS', href: '/clients'}
			];
		}
	};
}]);

// Manages the login functionality for the application
directives.directive('lmLogin', ['$rootScope', '$cookies', function($rootScope, $cookies) {
	return {
		restrict: 'E',
		replace: false,
		templateUrl: 'templates/login.html',
		link: function(scope, element, attrs) {
			var timeout= 300;

			if ($cookies.email) {
				scope.email = $cookies.email;
			}

			scope.submitLogin = function() {
				if (scope.remember) {
					$cookies.email = scope.email;
				}
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

/**
 * Renders the user menu when appropriate, when the user is logged in.
 */
directives.directive('lmUserPanel', ['$rootScope', function($rootScope) {
	return {
		restrict: 'E',
		replace: true,
		template: '<div class="user" ng-show="user.id">Logged in as <strong>{{user.name}}</strong> <span class="v_line"> | </span> <a href="/help">Help</a> <span class="v_line"> | </span> <a href="/profile">Profile</a> <span class="v_line"> | </span> <a href="" ng-click="logout()">Logout</a></div>',
		link: function(scope, element, attrs) {
			scope.user = $rootScope.user;
			scope.logout = function() {
				$rootScope.$broadcast('event:logoutRequest');
			};
		}
	};
}]);

/**
 * Determines the image to use for the "favourite" icon that is utilised
 * when showing logins. This will look into the user's favourites and determine
 * whether the grayscale image is to be used, or the star icon.
 */
directives.directive('lmFavouriteSrc', ['$rootScope', function($rootScope) {
	return {
		restrict: 'A',
		replace: false,
		link: function(scope, element, attrs) {
			setIcon(false);

			if ($rootScope.user && $rootScope.user.favourites) {
				var favs = $rootScope.user.favourites;

				for (var i = 0; i < favs.length; i++) {
					if (favs[i] == scope.login.id) {
						setIcon(true);
					}
				}
			}

			// Allows for the updating of a favourite login
			scope.setFavourite = function($event) {
				var favs = $rootScope.user.favourites;
				var login = this.login;

				$.post('/favourites/', {login_id: login.id});

				// update the image
				var fav = favs.indexOf(this.login.id);
				if (fav != -1) {
					$rootScope.user.favourites.splice(fav, 1);
					setIcon(false);
				}
				else {
					$rootScope.user.favourites.push(login.id);
					setIcon(true);
				}
			};

			// sets the image required for the favourite
			function setIcon(favourite) {
				var src = 'img/non-favourite.png';

				if (favourite) src = 'img/favourite.png';
				
				$(element).attr('src', src);
			}
		}
	};
}]);

