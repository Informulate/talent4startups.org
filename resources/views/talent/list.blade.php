@if (Request::ajax())
<script src="{{{ asset( 'js/vendors/holder/docs.min.js' ) }}}"></script>
@endif
<div class="row">
	<div class="col-sm-12">
		{!! $talents->render() !!}
	</div>
</div>
<div class="row">
	@if(Auth::user() && Auth::user()->startups()->count() > 0)
		<?php $startup = Auth::user()->startups()->orderByRaw("RAND()")->first(); ?>
		@if ($startup->matches()->count() > 0)
		<fieldset>
			<legend>Matches for {{ $startup->name }}</legend>
			@foreach($startup->matches()->limit(4)->get() as $match)
				<?php $talent = $match->user; ?>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 thumb">
						<small class="glyphicons glyphicons-handshake" style="position: absolute; top:517px; left: 25px; cursor: help; color: #009AFF" title="Based on mutual interest in {{ str_replace(PHP_EOL, ', ', strtolower($match->description)) }}"> Matched</small>
						@include('talent.thumb')
					</div>
			@endforeach()
		</fieldset>
		@endif
	@endif
	@foreach($talents as $index => $talent)
		@if ($index % 3 === 0)
			@if ($displayAds)
				<div class="col-sm-12 adsense center-block">
					<div>
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- TextMain -->
						<ins class="adsbygoogle"
							 style="display:inline-block;width:728px;height:90px"
							 data-ad-client="ca-pub-2707586338674770"
							 data-ad-slot="4166570841"></ins>
						<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
					</div>
				</div>
				<div class="clearfix"></div>
			@endif
		@endif

		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 thumb">
			@include('talent.thumb')
		</div>
	@endforeach()

	@if (count($talents) == 0)
		<div class="alert alert-warning">
			<h1><i class="glyphicons glyphicons-alert"></i> Warning!</h1>
			<p>No results found!</p>
		</div>
	@endif

</div>
<div class="row">
	<div class="col-sm-12">
		{!! $talents->render() !!}
	</div>
</div>

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function () {
			$('.member-rating-view').rating({
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
