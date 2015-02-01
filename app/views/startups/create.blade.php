@extends('layouts.default')

@section('css')
	<link href="{{{ asset( 'css/vendors/select2/select2.css') }}}" rel="stylesheet">
	<link href="{{{ asset( 'css/vendors/select2/select2-bootstrap.css') }}}" rel="stylesheet">
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>New Startup</h1>

			@include('layouts.partials.errors')

			{{ Form::open(['route' => ['startups.store'], 'method' => 'POST']) }}
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

            $('#add-need').on('click', function() {
                var formClone = $('#startup-needs-container div.need').clone();

                $('.startup-needs').append(formClone);

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

                $('.startup-needs .need-header select').on('change', function() {
                    if ($(this).attr('name').match(/(role)/)) {
                        @foreach($needs as $need)
                        $(this).closest('.need').removeClass('{{ strtolower($need) }}');
                        @endforeach
                        $(this).closest('.need').addClass($(this).children(':selected').text().toLowerCase());
                    }
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

            $('.startup-needs .need-header select').on('change', function() {
                if ($(this).attr('name').match(/(role)/)) {
                    @foreach($needs as $need)
                    $(this).closest('.need').removeClass('{{ strtolower($need) }}');
                    @endforeach
                    $(this).closest('.need').addClass($(this).children(':selected').text().toLowerCase());
                }
            });
        });
	</script>
@stop
