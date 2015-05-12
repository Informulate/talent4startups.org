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

            @if (count($startup->needs) > 2)
                <?php $needList = ""; ?>
                @foreach($startup->needs as $need)
                    <?php $needList .= ' ' . $need->quantity . ' ' . $need->skill->name . ','; ?>
                @endforeach
                <?php $needList = rtrim($needList, ','); ?>
                <span class="badge" style="float:right; cursor: pointer;" data-toggle="popover"  title="<i class='glyphicon glyphicon-tags'></i> All needs for {{ $startup->name }}"
                      data-content="{{ $needList }}" data-html="true" data-placement="left" >...</span>
            @endif

        <p>Startup Needs:
            {{ $startup->needs[0]->quantity }} {{ $startup->needs[0]->skill->name }},
            {{ $startup->needs[1]->quantity }} {{ $startup->needs[1]->skill->name }}
        </p>
 		<p class="text-muted">{{ str_limit( $startup->description, 300 ) }}</p>

	</div>
	<div class="clearfix"></div>
    <a href="{{ route('startups.show', $startup->url) }}" class="btn btn-primary pull-right learn-more"
          role="button">Learn More</a>

</div>
