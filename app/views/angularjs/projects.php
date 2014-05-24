<div class="row" ng-controller="ProjectsController">
	<div ng-repeat="project in projects">
		<div class="col-xs-12 col-md-4">
			<div class="well">
				<h4>{{ project.name }} <br/><small>By: {{ project.owner.username }}</small></h4>
				<p>{{ project.description }}</p>
				<p><a class="btn btn-primary" href="#">Learn More</a></p>
			</div>
		</div>
		<div ng-if="$index % 3 == 2" class="clearfix"></div>
	</div>
</div>
