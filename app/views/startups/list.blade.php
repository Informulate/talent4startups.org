	@if (Request::ajax())
		<script src="{{{ asset( 'js/vendors/holder/docs.min.js' ) }}}"></script>
	@endif
	<div class="row">
		<div class="col-sm-12">
			{{ $startups->links() }}
		</div>
	</div>
	<div class="row">
		@foreach($startups as $index => $startup)
			@if ($index % 3 === 0 and $index > 0)
				<div class="col-sm-6 col-md-4 col-lg-4 adsense">
					<div class="thumbnail startups">
						<img class="center-block img-responsive" src="https://storage.googleapis.com/support-kms-prod/SNP_2922332_en_v0">
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 adsense">
					<div class="thumbnail startups">
						<img class="center-block img-responsive" src="https://storage.googleapis.com/support-kms-prod/SNP_2922332_en_v0">
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 adsense">
					<div class="thumbnail startups">
						<img class="center-block img-responsive" src="https://storage.googleapis.com/support-kms-prod/SNP_2922332_en_v0">
					</div>
				</div>
			@endif
			<div class="col-sm-6 col-md-4 col-lg-4">
				<div class="thumbnail startups">
					<img data-src="holder.js/300x300" alt="...">
					<div class="caption">
						<h3>{{ $startup->name }} <br/><small>By: {{ $startup->owner->profile->first_name }} {{ $startup->owner->profile->last_name }}</small></h3>
						<h6><i class="glyphicons glyphicons-google-maps"></i>{{ $startup->owner->profile->location }}</h6>
						<p>Startup Needs: @foreach($startup->needs as $need ) {{ $need->quantity }} {{ $need->skill->name }} @endforeach</p>
						<p>{{ Str::limit( $startup->description, 50 ) }}</p>
						<p><a href="{{ route('startups.show', $startup->url) }}" class="btn btn-primary pull-right learn-more" role="button">Learn More</a></p>
					</div>
					<div class="clearfix"></div>
				</div>
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
			{{ $startups->links() }}
		</div>
		@include('layouts.partials.socialshare')
	</div>
