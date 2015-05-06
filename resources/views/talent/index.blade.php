@extends('app')

@section('content')
	<div class="row"> <!-- display search fields -->
		{!! Form::open(['route' => 'talents.index','name'=>'talent-search-form','id'=>'talent-search-form', 'method' =>
		'get']) !!}
		<div class="form-group col-sm-3">
			{!! Form::select('describes', array('Browse:everyone') + $describes,
			Input::get('describes'),['id'=>'describe','class' => 'form-control']); !!}
		</div>
		<div class="form-group col-sm-3">
			{!! Form::text('tag', Input::get('tag'), ['id'=>'tag','class' => 'form-control', 'placeholder' => 'Enter
			tag']) !!}
		</div>
		<div class="form-group col-sm-3">
			{!! Form::text('location', Input::get('location'), ['id'=>'location','class' => 'form-control',
			'placeholder' => 'Enter Location']) !!}
		</div>
		<div class="form-group col-sm-3">
			{!! Form::submit('Search', ['id'=>'search-button','class' => 'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}
	</div> <!-- display search fields ends -->
	<div id="talent-container">
		@include('talent.list')
	</div>
	@include('layouts.partials.socialshare')
@stop
