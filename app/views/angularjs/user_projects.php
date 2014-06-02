<span ng-init="username='<?php echo $username; ?>'"></span>
<div ng-controller="UserProjectsController" class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading">Your Projects <span class="badge">5</span> <a class="btn btn-xs btn-success pull-right" href="#">Add Project</a></div>
	<!-- List group -->
	<ul class="list-group">
		<li ng-repeat="project in projects" class="list-group-item"><a href="#">{{ project.name }}</a></li>
	</ul>
</div>
