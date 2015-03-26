@extends('app')

@section('content')
	<div class="text-center col-sm-offset-2 col-sm-8" id="sign-up-tab">
		<div class="row">
			@include('layouts.partials.type')
		</div>
		<div class="row">
			<div class="col-sm-6">
				<a class="btn btn-primary" href="{{ route('finish_linked_in_path', ['type' => 'startup']) }}">Sign Up As a StartUp</a>
			</div>
			<div class="col-sm-6">
				<a class="btn btn-primary" href="{{ route('finish_linked_in_path', ['type' => 'talent']) }}">Sign Up As a Talent</a>
			</div>
		</div>
	</div>
@stop
