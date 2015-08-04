@extends('app')

@section('content')

	<div class="row"> <!-- display search fields -->
		{!! Form::open(['route' => 'startups.index','name'=>'project-search-form','id'=>'project-search-form', 'method' => 'get']) !!}
			<div class="form-group col-sm-3">
				{!! Form::select('needs', array('Startups that Need: Everyone') + $needs, Input::get('needs'),['id'=>'needs','class' => 'form-control']); !!}
			</div>
			<div class="form-group col-sm-3">
				{!! Form::text('tag', Input::get('tag'), ['id'=>'tag','class' => 'form-control', 'placeholder' => 'Enter tag']) !!}
			</div>
			<div class="form-group col-sm-3">
				{!! Form::submit('Search', ['id'=>'search-button','class' => 'btn btn-primary']) !!}
			</div>
		{!! Form::close() !!}
	</div> <!-- display search fields ends -->

	@if(Auth::user())
		<a id="new-project-panel-btn" href="{{ route('startups.create') }}" class="pull-right btn btn-xs btn-success"><i class="glyphicons glyphicons-plus"></i> New startup</a>
	@endif

	<div id="project-container">
		@include('startups.list')
	</div>
@stop

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function () {
			$('.startup-rating-view').rating({
				readonly: true,
				showClear: false,
				showCaption: false,
				hoverEnabled: false,
				size: 'xs'
			});

			$('[data-toggle="popover"]').popover();

			$('body').on('click', function (e) {
				$('[data-toggle="popover"]').each(function () {
					//the 'is' for buttons that trigger popups
					//the 'has' for icons within a button that triggers a popup
					if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
						$(this).popover('hide');
					}
				});
			});
		});
	</script>
@stop
