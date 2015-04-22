@extends('app')

@section('css')
	<link href="{{{ asset( 'css/vendors/jcrop/jquery.Jcrop.min.css') }}}" rel="stylesheet">
	<style type="text/css">
		#profile-image {
			max-width: 100%;
			max-height: 100%;
		}
	</style>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<h1>Crop Photo</h1>
			<img id="profile-image" src="/images/upload/{{ $user->profile->image }}" alt=""/>
		</div>
	</div>
@stop

@section('side-content')
	<div class="row">
		<div class="col-xs-12">
			<!-- This is the form that our event handler fills -->
			<form action="{{{ route('profile_image_path') }}}" method="post" onsubmit="return checkCoords();">
				<input type="hidden" id="x" name="x" />
				<input type="hidden" id="y" name="y" />
				<input type="hidden" id="w" name="w" />
				<input type="hidden" id="h" name="h" />
				<input type="submit" value="Crop Photo" class="btn btn-large btn-primary" />
			</form>
		</div>
	</div>
@stop

@section('javascript')
	<script type="text/javascript" src="{{{ asset('js/vendors/jcrop/jquery.Jcrop.min.js') }}}"></script>
	<script type="text/javascript">
		function updateCoords(c)
		{
			$('#x').val(c.x);
			$('#y').val(c.y);
			$('#w').val(c.w);
			$('#h').val(c.h);
		};

		function checkCoords()
		{
			if (parseInt($('#w').val())) return true;
			sweetAlert('Crop a Region','Please select a crop region then press submit.');
			return false;
		};

		$(document).ready(function() {
			$('#profile-image').Jcrop({
				aspectRatio: 1,
				setSelect: [ 1, 1, 500, 500 ],
				onSelect: updateCoords
			});
		});
	</script>
@stop
