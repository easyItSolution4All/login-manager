function UserProfileCtrl($scope, $rootScope, User) {
	$scope.user = User.get({id: $rootScope.user.id});
	$scope.saveProfile = function() {
		$scope.user.$save();
	}
}
