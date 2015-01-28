@extends('layouts.default')

@section('css')
	<link href="{{{ asset( 'css/vendors/select2/select2.css') }}}" rel="stylesheet">
	<link href="{{{ asset( 'css/vendors/select2/select2-bootstrap.css') }}}" rel="stylesheet">
@stop

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>Edit Startup</h1>

			@include('layouts.partials.errors')

			{{ Form::model($startup, ['route' => ['startups.update', $startup->url], 'method' => 'PUT']) }}
				@include('layouts.partials.forms.startup')
			{{ Form::close() }}
		</div>
	</div>
@stop

@section('javascript')
	<script src="{{{ asset( 'js/vendors/select2/select2.min.js' ) }}}"></script>
	<script type="text/javascript">
    $(document).ready(function() {
        $('#tags').select2({
            'tags': [
                    @foreach($tags as $tag)
                        '{{ $tag }}',
                    @endforeach
            ]
        });

        $('#needs').select2({
            'tags': [
                @foreach($needs as $need)
                '{{ $need }}',
                @endforeach
            ]
        });

        $('#add-need').on('click', function() {
            var formClone = $('#startup-needs-container div.need').clone();

            $(this).parent('.startup-needs').append(formClone);

            var cloneIndex = $('.startup-needs .need').length;
            $('.startup-needs .need').find('*').each(function () {
                var name = this.name || '';
                var match = name.match(/(\d)+/i);
                if (!match && name.length > 0) {
                    if (!name.match(/\[\]$/i)) {
                        this.name = 'needs[' + cloneIndex + '][' + name + ']';
                    } else {
                        this.name = 'needs[' + cloneIndex + '][' + name.replace('[]', '') + '][]';
                    }
                }
            });

            $(formClone).find('.remove').on('click', function() {
                  $(this).parent('.need').remove();
             });
            cloneIndex++;

            $('.startup-needs .need .tags').select2({
                'tags': [
                    @foreach($tags as $tag)
                        '{{ $tag }}',
                    @endforeach
                ]
            });
        });

        $('.need .remove').on('click', function() {
              $(this).parent('.need').remove();
         });
         $('.startup-needs .need .tags').select2({
             'tags': [
                 @foreach($tags as $tag)
                     '{{ $tag }}',
                 @endforeach
             ]
         });
    });
	</script>
@stop
