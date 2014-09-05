@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>Hello, <?php echo $project->name; ?></h1>
		</div>
	</div>
@stop
