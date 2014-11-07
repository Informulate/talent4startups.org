	@if (Request::ajax())
	<script src="{{{ asset( 'js/vendors/holder/docs.min.js' ) }}}"></script>
	@endif
	<div class="row">
		<div class="col-sm-12">
			{{ $talents->links() }}
		</div>
	</div>
	<div class="row">
		@foreach($talents as $talent)
			<div class="col-lg-3 col-md-4 col-xs-6 thumb">
				<div class="thumbnail">
					<img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $talent->email ) ) ) ?>?s=300">
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
	</div>
	<div class="row">
		<div class="col-sm-12">
			{{ $talents->links() }}
		</div>
	</div>
