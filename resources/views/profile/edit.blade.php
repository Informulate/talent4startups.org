@extends('app')

@section('css')
	<link href="{{{ asset( 'css/vendors/select2/select2.css') }}}" rel="stylesheet">
	<link href="{{{ asset( 'css/vendors/select2/select2-bootstrap.css') }}}" rel="stylesheet">
@stop

@section('wide-content')
	@if (Request::path() == 'setup/profile')
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					@include('partials.registration.steps')
				</div>
			</div>
		</div>
	@endif
@endsection

@section('content')
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

@section('footer')
	@if (Request::path() == "profile")
		@include('layouts.partials.footer')
	@endif
@overwrite
