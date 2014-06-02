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

function ProjectsController($scope, $http) {

	$http.get('/api/v1/projects?limit=9').success(function(projects) {
		$scope.projects = projects['data'];
		$scope.paginator = projects['paginator']
	});

}

function UserProjectsController($scope, $http) {
	var url = '/api/v1/users/' + $scope.username + '/projects';
	console.log(url);

	$http.get('/api/v1/projects?limit=5').success(function(projects) {
		$scope.projects = projects['data'];
		$scope.paginator = projects['paginator']
	});
}
