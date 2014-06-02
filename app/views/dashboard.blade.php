@extends('layouts.master')

@section('content')
	<div class="container">
		<div class="row">
			<h1>Dashboard</h1>
			<div class="col-md-9">
				<h2>Welcome {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
			</div>
			<div class="col-md-3">
				@include('angularjs/user_projects', ['username' => Auth::user()->username])
			</div>
		</div>
	</div>
@stop
