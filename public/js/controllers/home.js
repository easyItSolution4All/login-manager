function HomeCtrl($scope, Favourite) {
	$scope.favourites = Favourite.query();
}