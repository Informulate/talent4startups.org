function OccupationsController($scope, $http) {

	$http.get('/api/v1/occupations').success(function(occupations) {
		$scope.occupations = occupations['data'];
	});

}
