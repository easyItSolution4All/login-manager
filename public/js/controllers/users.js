function UserProfileCtrl($scope, $rootScope, Profile) {
	$scope.user = Profile.get();

	$scope.saveProfile = function() {
		$scope.user.$save();
		$rootScope.go('/logins');
	}
}
