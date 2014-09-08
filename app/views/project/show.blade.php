@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
<<<<<<< HEAD
			<h1>Hello, <?php echo $project->name; ?></h1>
=======
			<h1>Project Detail Page</h1>

			@include('layouts.partials.errors')

			@include('layouts.partials.forms.project', [ 'project' => $project ])
>>>>>>> Enabled SASS. Project now using SASS. Lists all projects, user can delete project, see details of specific projects. Added AJAX, colorbox
		</div>
	</div>
@stop
