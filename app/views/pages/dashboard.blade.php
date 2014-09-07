@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-sm-8">
			<ul class="media-list">
				<li class="media">
					<a class="pull-left" href="#">
						<img class="media-object img-circle" data-src="holder.js/64x64/auto">
					</a>
					<div class="media-body">
						<h4 class="media-heading">Media heading</h4>
						<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
					</div>
				</li>
				<li class="media">
					<a class="pull-left" href="#">
						<img class="media-object img-circle" data-src="holder.js/64x64/auto">
					</a>
					<div class="media-body">
						<h4 class="media-heading">Media heading</h4>
						<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
					</div>
				</li>
				<li class="media">
					<a class="pull-left" href="#">
						<img class="media-object img-circle" data-src="holder.js/64x64/auto">
					</a>
					<div class="media-body">
						<h4 class="media-heading">Media heading</h4>
						<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
					</div>
				</li>
			</ul>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Projects you contribute to</h3>
				</div>
				<div class="list-group">
					<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
					<a href="#" class="list-group-item">Morbi leo risus</a>
					<a href="#" class="list-group-item">Porta ac consectetur ac</a>
					<a href="#" class="list-group-item">Vestibulum at eros</a>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Your projects <a id="new-project-panel-btn" href="{{ route('projects.create') }}" class="pull-right btn btn-xs btn-success"><i class="glyphicons plus"></i> New project</a></h3>
				</div>
				<div class="list-group">
					<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
					<a href="#" class="list-group-item">Morbi leo risus</a>
					<a href="#" class="list-group-item">Porta ac consectetur ac</a>
					<a href="#" class="list-group-item">Vestibulum at eros</a>
				</div>
			</div>
		</div>
	</div>
@stop
