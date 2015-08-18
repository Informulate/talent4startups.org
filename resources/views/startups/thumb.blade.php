<div class="thumbnail startups">
	<a class="signup-link" href="{{ route('startups.show', $startup->url) }}">
		@if ($startup->image)
			<div class="profile-image" style="background-image: url('/images/upload/{{ $startup->image }}')"></div>
		@else
			<img src="{{ asset('images/startups_generic.jpg') }}" alt="Startup"/>
		@endif
	</a>

	<input data-id="{{ $startup->id }}" type="number" class="startup-rating-view" value="{{ $startup->rating() }}" }}>

	<div class="caption">
		<h3><a class="signup-link" href="{{ route('startups.show', $startup->url) }}">{{ str_limit( $startup->name, 15 ) }}</a>
			@if ($startup->isNew())
				<img src="{{ asset('images/new-badge-red-128.png') }}" alt="new" width="25" height="25"/>
			@endif
			<br/>
			<small>By: {{ $startup->owner->profile->first_name }} {{ $startup->owner->profile->last_name }}</small>
		</h3>
		<h6><i class="glyphicons glyphicons-google-maps"></i>{{ $startup->owner->profile->location }}</h6>

		@foreach($startup->needs as $need)
			<?php $needsArray[] = ' ' . $need->quantity . ' ' . $need->skill->name; ?>
		@endforeach

		@if (isset($needsArray) and count($needsArray) > 2)
			<?php $needList = ""; ?>
			@foreach($needsArray as $need)
				<?php $needList .= $need . ','; ?>
			@endforeach

			<?php $needList = rtrim($needList, ','); ?>

			<span class="badge" style="float:right; cursor: pointer;" data-toggle="popover" title="<i class='glyphicon glyphicon-tags'></i> All needs for {{ $startup->name }}" data-content="{{ $needList }}" data-html="true" data-placement="left">...</span>
		@endif

		<p>Startup Needs:
			@if (isset($needsArray))
			{{ count($needsArray) > 0 ? ', ' . $needsArray[0] : '' }} {{ count($needsArray) > 1 ? ', ' . $needsArray[1] : '' }}
			@endif
		</p>

		<p class="text-muted">{{ str_limit( $startup->description, 60 ) }}</p>

	</div>
	<div class="clearfix"></div>
	<a href="{{ route('startups.show', $startup->url) }}" class="btn btn-primary pull-right learn-more signup-link" role="button">Learn More</a>

</div>
