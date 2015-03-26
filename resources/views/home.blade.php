@extends('app')

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<h1 class="text-center">Grow your startup. Join a team.</h1>
		</div>
	</div>
	<div class="row">
		@foreach($startups as $index => $startup)
			<div class="col-md-3 col-xs-12 thumb">
				@include('startups.thumb')
			</div>
		@endforeach()
		@foreach($talents as $index => $talent)
			<div class="col-md-3 col-xs-12 thumb">
				@include('talent.thumb')
			</div>
		@endforeach()
	</div>
	@include('layouts.partials.socialshare')
@endsection
