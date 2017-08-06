<div class="thumbnail">
	<a href="{{ route('profile_path', $talent->id) }}">
		<img class="profile-image signup-link" src="{{{ $talent->avatar() }}}?d=mm">
	</a>

	<div class="caption">
		<h3>
			<a class="signup-link" href="{{ route('profile_path', $talent->id) }}">{{ $talent->first_name }} {{ $talent->last_name }}</a>
			@if ($talent->isNew())
				<img class="new-badge" src="{{ asset('images/new-badge-red-128.png') }}" alt="new" width="25" height="25"/>
			@endif
		</h3>
		<h6>{{ $talent->profile->skill->name }} from {{ $talent->profile->location }} <i class="glyphicons glyphicons-google-maps"></i></h6>

		<p>{{ str_limit($talent->profile->about, 120) }}</p>

		<p>
			<i class="glyphicon glyphicon-tags"></i>
			@foreach($talent->profile->previewTags() as $tag)
                <a href="{{{ route('talents.index') }}}?tag={{ $tag->name }}"><span class="badge">{{ str_limit($tag->name, 20) }}</span></a>
			@endforeach
            @if ($talent->profile->hasHiddenTags())
                <?php $tagList = ""; ?>
                @foreach($talent->profile->tags as $tag)
                    <?php $tagList .= '<span class="badge" style="margin-right: 3px;">' . str_limit($tag->name, 20) . '</span>'; ?>
                @endforeach
                <span class="badge" style="margin-top: 3px; float: right;cursor: pointer;" data-toggle="popover"  title="<i class='glyphicon glyphicon-tags'></i> All tags for {{ $talent->first_name }} {{ $talent->last_name }}"
                      data-content="{{ $tagList }}" data-html="true" data-placement="left" >...</span>
            @endif
		</p>

		<p><a href="{{ route('profile_path', $talent->id) }}" class="btn btn-primary pull-right signup-link" role="button">Learn More</a></p>
	</div>
	<div class="clearfix"></div>
</div>
