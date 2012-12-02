function ProjectListCtrl($scope, Project, Client) {
	$scope.selectClient = function(event) {
		event.stopPropagation();
		event.preventDefault();

		if (this.project)
			$scope.clientId = this.project.client_id;
		else
			$scope.clientId = null;
	}
	
	$scope.delete = function(event) {
		event.stopPropagation();
		event.preventDefault();
		
		var response = confirm('Are you sure you want to remove this item?');
		
		if (response) {
			$scope.projects.splice(this.$index, 1);
			this.project.$destroy();
		}
	};

	$scope.clientId = null;
	$scope.projects = Project.query();
}

function ProjectCreateCtrl($scope, $location, Project, Client) {
	$scope.action = 'CREATE';
	$scope.clients = Client.query();
	$scope.project = new Project;

	$scope.saveProject = function(scope) {
		_saveProject(scope, $location);
	}
}

function ProjectEditCtrl($scope, $location, $routeParams, Project, Client) {
	$scope.action = 'EDIT';
	$scope.project = Project.get({ id: $routeParams.projectId });
	$scope.clients = Client.query();

	$scope.saveProject = function(scope) {
		_saveProject(scope, $location);
	}
}

function _saveProject(scope, $location) {
	var result = scope.project.$save({}, 
		function() {
			$location.path('/projects');
		},
		function() {
			console.log('nup');
		}
	);
}
