	<div class="row">
		<div class="col-sm-12">
			{!! $startups->render() !!}
		</div>
	</div>

	<div class="row">
		@if(Auth::user() && Auth::user()->matches() && Auth::user()->matches()->limit(4)->get()->count() > 0)
			<fieldset>
			<legend>Matches</legend>
			@foreach(Auth::user()->matches()->limit(4)->get() as $match)
				<?php $startup = $match->startup; ?>
				<div class="col-sm-6 col-md-3 col-lg-3">
					<span class="glyphicons glyphicons-handshake" style="position: absolute; top:517px; left: 25px; cursor: help; color: #009AFF" title="Based on mutual interest in {{ str_replace(PHP_EOL, ', ', strtolower($match->description)) }}"> Matched</span>
					@include('startups.thumb')
				</div>
			@endforeach()
			</fieldset>
		@endif

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
					<div class="clearfix"></div>
				@endif
			@endif

			<div class="col-sm-6 col-md-3 col-lg-3">
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