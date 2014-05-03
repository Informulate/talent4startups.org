function OccupationsController($scope, $http) {

	$http.get('/api/v1/occupations').success(function(occupations) {
		$scope.occupations = occupations['data'];
	});

}

function UsersController($scope, $http) {

	$http.get('/api/v1/users').success(function(users) {
		$scope.users = users['data'];
	});

}
