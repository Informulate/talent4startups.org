	@if (Request::ajax())
	<script src="{{{ asset( 'js/vendors/holder/docs.min.js' ) }}}"></script>
	@endif
	<div class="row">
		<div class="col-sm-12">
			{{ $talents->links() }}
		</div>
	</div>
	<div class="row">
		@foreach($talents as $index => $talent)
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
			<div class="col-lg-4 col-md-4 col-xs-6 thumb">
				<div class="thumbnail">
					<img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $talent->email ) ) ) ?>?s=300&d=wavatar">
					<input data-id="{{ $talent->id }}" type="number" class="member-rating-view" value="{{ $talent->rating() }}" }}>
					<div class="caption">
						<h3><a href="{{ route('profile_path', $talent->username) }}">{{ $talent->profile->first_name }} {{ $talent->profile->last_name }}</a></h3>
						<h6><i class="glyphicons glyphicons-google-maps"></i>{{ $talent->profile->location }}</h6>
						<p>{{ $talent->profile->skill->name }}</p>
						<p>{{ Str::limit($talent->profile->about, 160) }}</p>
						<p><i class="glyphicon glyphicon-tags"></i>
							@foreach($talent->profile->tags as $tag)
								<span class="badge">{{ $tag->name }}</span>
							@endforeach
						</p>
						<p><a href="{{ route('profile_path', $talent->username) }}" class="btn btn-primary pull-right" role="button">Learn More</a></p>
					</div>
					<div class="clearfix"></div>
				</div>
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
			{{ $talents->links() }}
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
			});
		</script>
	@stop
