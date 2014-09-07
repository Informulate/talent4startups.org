@extends('layouts.default')

@section('content')
	<div class="row">
		@foreach($projects as $project)
			<div class="col-sm-6 col-md-3">
				<div class="thumbnail">
					<img data-src="holder.js/300x300" alt="...">
					<div class="caption">
						<h3><?php echo $project->name; ?></h3>
						<h6><i class="glyphicons google_maps"></i>Orlando, FL.</h6>
						<p>Project Needs: Developers, Writers, Project Managers</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit dolorem eius, asperiores magnam perspiciatis dolor ratione dolores impedit qui. Rerum amet, iusto. Eaque neque expedita similique veniam nihil ab perspiciatis.</p>
						<p><a href="{{ route('projects.show', $project->url) }}" class="btn btn-primary pull-right" role="button">Learn More</a></p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		@endforeach()
	</div>
@stop
