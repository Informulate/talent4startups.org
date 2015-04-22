<div class="thumbnail">
	<a href="{{ route('profile_path', $talent->id) }}">
		<img class="img-responsive" src="{{{ $talent->profile->avatar() }}}?s=250&d=mm" width="250" height="250">
	</a>

	<input data-id="{{ $talent->id }}" type="number" class="member-rating-view" value="{{ $talent->rating() }}">

	<div class="caption">
		<h3>
			<a href="{{ route('profile_path', $talent->id) }}">{{ $talent->profile->first_name }} {{ $talent->profile->last_name }}</a>
		</h3>
		<h6><i class="glyphicons glyphicons-google-maps"></i>{{ $talent->profile->location }}</h6>

		<p>{{ $talent->profile->skill->name }}</p>

		<p>{{ str_limit($talent->profile->about, 160) }}</p>

		<p>
			<i class="glyphicon glyphicon-tags"></i>
			@foreach($talent->profile->tags as $tag)
				<span class="badge">{{ $tag->name }}</span>
			@endforeach
		</p>

		<p><a href="{{ route('profile_path', $talent->id) }}" class="btn btn-primary pull-right" role="button">Learn More</a></p>
	</div>
	<div class="clearfix"></div>
</div>
