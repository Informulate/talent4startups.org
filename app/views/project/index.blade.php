@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-sm-12">
			{{ $projects->links() }}
		</div>
	</div>
	<div class="row">
		@foreach($projects as $project)
			<div class="col-sm-6 col-md-3">
				<div class="thumbnail projects">
					<img data-src="holder.js/300x300" alt="...">
					<div class="caption">
						<h3>{{ $project->name }} <br/><small>By: {{ $project->owner->profile->first_name }} {{ $project->owner->profile->last_name }}</small></h3>
						<h6><i class="glyphicons google_maps"></i>Orlando, FL.</h6>
						<p>Project Needs: Developers, Writers, Project Managers</p>
						<p>{{ Str::limit( $project->description, 50 ) }}</p>
						<p><a href="{{ route('projects.show', $project->url) }}" class="btn btn-primary pull-right learn-more" role="button">Learn More</a></p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		@endforeach()
	</div>
	<div class="row">
		<div class="col-sm-12">
			{{ $projects->links() }}
		</div>
	</div>
@stop
