	@if (Request::ajax())
	<script src="{{{ asset( 'js/vendors/holder/docs.min.js' ) }}}"></script>
	@endif
	<div class="row">
		<div class="col-sm-12">
			{{ $talents->links() }}
		</div>
	</div>
		@foreach($talents as $talent)
			<div class="col-sm-6 col-md-3">
				<div class="thumbnail">
					<img data-src="holder.js/300x300" alt="...">
					<div class="caption">
						<h3><a href="{{ route('profile_path', $talent->username) }}">{{ $talent->profile->first_name }} {{ $talent->profile->last_name }}</a></h3>
						<h6><i class="glyphicons google_maps"></i>{{ $talent->profile->location }}</h6>
						<p>{{ $talent->profile->describe }} TODO: This needs fixing</p>
						<p>{{ $talent->profile->about }}</p>
						<p><a href="{{ route('profile_path', $talent->username) }}" class="btn btn-primary pull-right" role="button">Learn More</a></p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		@endforeach()
	<div class="row">
		<div class="col-sm-12">
			{{ $talents->links() }}
		</div>
	</div>