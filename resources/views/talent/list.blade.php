@if (Request::ajax())
<script src="{{{ asset( 'js/vendors/holder/docs.min.js' ) }}}"></script>
@endif
<div class="row">
	<div class="col-sm-12">
		{!! $talents->render() !!}
	</div>
</div>
<div class="row">
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

		<div class="col-lg-4 col-md-4 col-sm-12 thumb">
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
