<div class="thumbnail startups">
	<a href="{{ route('startups.show', $startup->url) }}">
		@if ($startup->image)
			<div class="profile-image" style="background-image: url('/images/upload/{{ $startup->image }}')"></div>
		@else
			<img data-src="holder.js/250x250" alt="...">
		@endif
	</a>

	<div class="caption">
		<h3><a href="{{ route('startups.show', $startup->url) }}">{{ $startup->name }}</a> <br/>
			<small>By: {{ $startup->owner->profile->first_name }} {{ $startup->owner->profile->last_name }}</small>
		</h3>
		<h6><i class="glyphicons glyphicons-google-maps"></i>{{ $startup->owner->profile->location }}</h6>

		<p>Startup
			Needs: @foreach($startup->needs as $need ) {{ $need->quantity }} {{ $need->skill->name }} @endforeach</p>

		<p class="text-muted">{{ Str::limit( $startup->description, 50 ) }}</p>

		<p><a href="{{ route('startups.show', $startup->url) }}" class="btn btn-primary pull-right learn-more"
			  role="button">Learn More</a></p>
	</div>
	<div class="clearfix"></div>
</div>
