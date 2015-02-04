@extends('layouts.default')

@section('content')

	<div class="row"> <!-- display search fields -->
		{{ Form::open(['route' => 'startups.index','name'=>'project-search-form','id'=>'project-search-form', 'method' => 'get']) }}
			<div class="form-group col-sm-3">
				{{ Form::select('needs', array('Startups that Need: Everyone') + $needs, Input::get('needs'),['id'=>'needs','class' => 'form-control']); }}
			</div>
			<div class="form-group col-sm-3">
				{{ Form::text('tag', Input::get('tag'), ['id'=>'tag','class' => 'form-control', 'placeholder' => 'Enter tag']) }}
			</div>
			<div class="form-group col-sm-3">
				{{ Form::submit('Search', ['id'=>'search-button','class' => 'btn btn-primary']) }}
			</div>
		{{ Form::close() }}
	</div> <!-- display search fields ends -->

	<a id="new-project-panel-btn" href="{{ route('startups.create') }}" class="pull-right btn btn-xs btn-success"><i class="glyphicons glyphicons-plus"></i> New startup</a>

	<div id="project-container">
		@include('startups.list')
	</div>
@stop
