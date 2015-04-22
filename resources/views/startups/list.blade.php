	<div class="row">
		<div class="col-sm-12">
			{!! $startups->render() !!}
		</div>
	</div>

	<div class="row">
		@foreach($startups as $index => $startup)
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
				@else
				@endif

				<div class="clearfix"></div>
			@endif

			<div class="col-sm-6 col-md-4 col-lg-4">
				@include('startups.thumb')
			</div>
		@endforeach()

		@if (count($startups) == 0)
			<div class="alert alert-warning">
				<h1><i class="glyphicons glyphicons-alert"></i> Warning!</h1>
				<p>No results found!</p>
			</div>
		@endif

	</div>
	<div class="row">
		<div class="col-sm-12">
			{!! $startups->render() !!}
		</div>
		@include('layouts.partials.socialshare')
	</div>
