@extends('layouts.default')
@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>Reset Password</h1>
			@include('layouts.partials.errors')
			 @if (Session::has('error'))
				<div class="alert alert-danger"><ul>
				</li>{{ Session::get('error') }}</li>
				</ul></div>
		   
		   	 @endif
			@include('layouts.partials.forms.reset_password')
		</div>
	</div>
@stop