@extends('layouts.master')

@section('content')
	<div class="container">
		<div class="row">
			<h1>Dashboard</h1>
			<div class="col-md-9">
				Main Stuff...
			</div>
			<div class="col-md-3">
				@include('angularjs/user_projects', ['username' => Auth::user()->username])
			</div>
		</div>
	</div>
@stop
