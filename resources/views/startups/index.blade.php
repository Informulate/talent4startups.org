@extends('app')

@section('css')
    <link href="{{{ asset( 'css/vendors/select2/select2.css') }}}" rel="stylesheet">
    <link href="{{{ asset( 'css/vendors/select2/select2-bootstrap.css') }}}" rel="stylesheet">
@stop

@section('content')

	<div class="row"> <!-- display search fields -->
		{!! Form::open(['route' => 'startups.index','name'=>'project-search-form','id'=>'project-search-form', 'method' => 'get']) !!}
			<div class="form-group col-sm-3">
				{!! Form::select('needs', array('Browse: All Roles') + $needs, Input::get('needs'),['id'=>'needs','class' => 'form-control']); !!}
			</div>
			<div class="form-group col-sm-3">
                {!! Form::text('tags', input::get('tags'), ['id' => 'tags', 'class' => 'form-control', 'placeholder' => 'Enter Tag(s)']) !!}
			</div>
            <div class="form-group col-sm-3">
                {!! Form::text('description', input::get('description'), ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Enter Description keyword']) !!}
            </div>
			<div class="form-group col-sm-3">
				{!! Form::submit('Search', ['id'=>'search-button','class' => 'btn btn-primary']) !!}
                @if(Auth::user())
            		<a id="new-project-panel-btn" href="{{ route('startups.create') }}" class="pull-right btn btn-success"><i class="glyphicons glyphicons-plus"></i> Add your startup</a>
            	@endif
			</div>
		{!! Form::close() !!}
	</div> <!-- display search fields ends -->

	<div id="project-container">
		@include('startups.list')
	</div>
@stop

@section('javascript')
    <script src="{{{ asset( 'js/vendors/select2/select2.min.js' ) }}}"></script>
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

            $('#tags').select2({
                'tags': [
                    @foreach($tags as $tag)
                    '{{ $tag }}',
                    @endforeach
                ]
            });

        });

		@if(getenv('APP_ENV') == 'prod')
			mixpanel.track("StartupList:View");
		@endif
	</script>
@stop
