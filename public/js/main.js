function SkillsController($scope, $http) {

	$http.get('/api/v1/skills').success(function(skills) {
		$scope.skills = skills['data'];
	});

}

function UsersController($scope, $http) {

	$http.get('/api/v1/users').success(function(users) {
		$scope.users = users['data'];
	});

}
