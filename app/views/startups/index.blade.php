@extends('layouts.default')

@section('content')

	<div class="row"> <!-- display search fields -->
		{{ Form::open(['route' => 'startups_search','name'=>'project-search-form','id'=>'project-search-form']) }}
			<div class="form-group col-sm-3">
				{{ Form::select('needs', array('Startups that Need: Everyone') + $needs, null,['id'=>'needs','class' => 'form-control']); }}
			</div>
			<div class="form-group col-sm-3">
				{{ Form::text('tag', null, ['id'=>'tag','class' => 'form-control']) }}
			</div>
			<div class="form-group col-sm-3">
				{{ Form::button('Search', ['id'=>'search-button','class' => 'btn btn-primary']) }}
			</div>
		{{ Form::close() }}
	</div> <!-- display search fields ends -->

	<div id="project-container">
		@include('startups.list')
	</div>
@stop
