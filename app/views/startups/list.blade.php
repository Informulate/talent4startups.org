	@if (Request::ajax())
	<script src="{{{ asset( 'js/vendors/holder/docs.min.js' ) }}}"></script>
	@endif
	<div class="row">
		<div class="col-sm-12">
			{{ $startups->links() }}
		</div>
	</div>
	<div class="row">
		@foreach($startups as $startup)
			<div class="col-sm-6 col-md-3">
				<div class="thumbnail startups">
					<img data-src="holder.js/300x300" alt="...">
					<div class="caption">
						<h3>{{ $startup->name }} <br/><small>By: {{ $startup->owner->profile->first_name }} {{ $startup->owner->profile->last_name }}</small></h3>
						<h6><i class="glyphicons google_maps"></i>Orlando, FL.</h6>
						<p>Startup Needs: @foreach($startup->needs as $need ) {{ $need->name }} @endforeach</p>
						<p>{{ Str::limit( $startup->description, 50 ) }}</p>
						<p><a href="{{ route('startups.show', $startup->url) }}" class="btn btn-primary pull-right learn-more" role="button">Learn More</a></p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		@endforeach()
	</div>
	<div class="row">
		<div class="col-sm-12">
			{{ $startups->links() }}
		</div>
	</div>
