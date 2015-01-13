@extends('layouts.default')
@if (Session::has('error'))
	<div class="alert alert-danger">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				{{ Session::get('error') }}
	</div>
@endif
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
			@if(count($contributions) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Startups you contribute to</h3>
					</div>
					<div class="list-group">
						@foreach($contributions as $startup)
							<a href="{{ route('startups.show', $startup->url) }}" class="list-group-item">{{ $startup->name }}</a>
						@endforeach
					</div>
				</div>
			@endif
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Your startups <a id="new-project-panel-btn" href="{{ route('startups.create') }}" class="pull-right btn btn-xs btn-success"><i class="glyphicons glyphicons-plus"></i> New startup</a></h3>
				</div>
				<div class="list-group">
					@foreach($myStartups as $startup)
					<a href="{{ route('startups.show', $startup->url) }}" class="list-group-item">{{ $startup->name }}</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@stop
