@extends('layouts.default')

@section('css')
	<link href="{{{ asset( 'css/vendors/select2/select2.css') }}}" rel="stylesheet">
	<link href="{{{ asset( 'css/vendors/select2/select2-bootstrap.css') }}}" rel="stylesheet">
@stop

@section('content')
	<div class="alert alert-info alert-dismissible fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
		</button>
		<h4>Where is my profile picture?</h4>

		<p>To update your profile picture you need to update your <a class="alert-link" href="https://secure.gravatar.com">gravatar</a>. You can do this by visiting and login in at <a class="alert-link" href="https://secure.gravatar.com">Gravatar.com</a></p>

		<p>A Gravatar is a Globally Recognized Avatar. You upload it and create your profile just once, and then when you participate in any Gravatar-enabled site, your Gravatar image will automatically follow you there.</p>
	</div>
	<div class="row">
		<div class="col-md-6">
			@include('layouts.partials.errors')

			@include('layouts.partials.forms.profile')
		</div>
	</div>
@stop

@section('javascript')
	<script src="{{{ asset( 'js/vendors/select2/select2.min.js' ) }}}"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#describe').select2();
			$('#skills').select2({
				'tags': [
					@foreach($skills as $tag)
					'{{ $tag }}',
					@endforeach
				]
			});
		});
	</script>
@stop
