@extends('app')

@section('content')
	<div class="row">
		<div class="col-md-9">
			<h1>{{ $startup->name }} @if(Auth::id() == $startup->owner->id) <a class="btn btn-primary btn-xs" href="{{ route('startups.edit', $startup->url) }}">Edit</a> @endif</h1>

			@if ($startup->image)
				<div class="profile-image-lg"
					 style="background-image: url('/images/upload/{{ $startup->image }}')"></div>
				<div class="clearfix"></div>
			@endif

			@if($startup->tagline)
				<h5 class="text-muted">{{ $startup->tagline }}</h5>
			@endif

			@markdown($startup->description)

			<div>
				@foreach($startup->tags as $tag)
					<a href="{{{ route('startups.index') }}}?tag={{ $tag->name }}"><span class="badge">{{ $tag->name }}</span></a>&nbsp;
				@endforeach
			</div>

			@foreach($startup->needs as $need)
				<div class="startup-need">
					<h4 class="{{ strtolower($need->skill->name) }}"><span class="glyphicons glyphicons-chevron-right"></span> {{ $need->skill->name }}</h4>

					<div class="clearfix"></div>
					@if(Auth::user() and $startup->owner->id != Auth::id() and false === $startup->hasPendingInvitationFrom(Auth::user()) and false == $startup->hasMember(Auth::user()))
						<a class="btn btn-primary pull-right" href="{{ route('startup_membership_request', ['url' => $startup->url]) }}">Apply</a>
					@endif
					@foreach($need->tags as $tag)
						<span class="badge">{{ $tag->name }}</span>
					@endforeach
					<div>
						@markdown($need->description)
					</div>

					<p class="text-muted">
						Commitment: {{ $need->commitment }}
					</p>
				</div>
			@endforeach

			@include('layouts.partials.socialshare')
		</div>
		<div class="col-md-3">
			<h4>Startup Rating</h4>

			@if(Auth::user() and $startup->isApprovedMember(Auth::user()))
				<p><input data-id="{{ $startup->id }}" type="number" class="rating startup-rating" min=0 max=5 step=0.5 data-size="xs" value="{{ $startup->rating() }}"></p>
			@else
				<p><input data-id="{{ $startup->id }}" type="number" class="startup-rating-view" value="{{ $startup->rating() }}" }}></p>
			@endif
			<div class="social-links">
				@if ($startup->website)
					<p class="glyphicons glyphicons-home"><a href="{{ $startup->website }}" target="_blank" rel="nofollow">Website</a></p>
				@endif

				@if ($startup->linked_in)
					<p class="glyphicons social social-linked-in"><a href="{{ $startup->linked_in }}" target="_blank" rel="nofollow">LinkedIn</a></p>
				@endif

				@if ($startup->facebook)
					<p class="glyphicons social social-facebook"><a href="{{ $startup->facebook }}" target="_blank" rel="nofollow">Facebook</a></p>
				@endif

				@if ($startup->twitter)
					<p class="glyphicons social social-twitter"><a href="{{ $startup->twitter}}" target="_blank" rel="nofollow">Twitter</a></p>
				@endif
			</div>

			@if(Auth::user() and $startup->owner->id == Auth::id())
				<h4>New Member requests</h4>

				@if (count($requests) == 0)
					<div class="alert alert-info" role="alert">No Pending Requests</div>
				@endif

				@foreach($requests as $user)
					<div>
						<a href="{{ route('profile_path', $user->id) }}"><img class="img-circle img-responsive" src="{{ $user->avatar() }}?s=64&d=mm" alt="" width="64" height="64"/></a>

						<div class="text-center" style="width: 64px;">
							<a class="text-success" href="{{ route('startup_membership_update', ['startup' => $startup->url, 'userId' => $user->id, 'action' => 'approve']) }}"><i class="glyphicon glyphicon-ok"></i></a>
							<a href="{{ route('startup_membership_update', ['startup' => $startup->url, 'userId' => $user->id, 'action' => 'reject']) }}"><i class="glyphicon glyphicon-remove"></i></a>
							<p><a href="{{ route('profile_path', $user->id) }}">{{ $user->first_name }} {{ $user->last_name }}</a></p>
						</div>
					</div>
				@endforeach

			@endif

			<h4>Current Startup Contributors</h4>
			@if(Auth::user() and $startup->owner->id != Auth::id() and false === $startup->hasPendingInvitationFrom(Auth::user()) and false == $startup->hasMember(Auth::user()))
				<a class="btn btn-primary" style="margin-bottom: 20px;" href="{{ route('startup_membership_request', ['url' => $startup->url]) }}">Join this startup</a>
			@endif

			<div class="row contributor">
				<a href="{{ route('profile_path', $startup->owner->id) }}">
					<div class="col-xs-4">
						<img class="img-circle img-responsive" src="{{ $startup->owner->avatar() }}?s=150&d=mm" alt="" width="150" height="150"/>
						<p style="text-align: center;">{{ $startup->owner->first_name }} {{ $startup->owner->last_name }}</p>
					</div>
				</a>
				@foreach($members as $user)
					<a href="{{ route('profile_path', $user->id) }}">
						<div class="col-xs-4">
							<img class="img-circle img-responsive" src="{{ $user->avatar() }}?s=150&d=mm" alt="" width="150" height="150"/>
							<p style="text-align: center;">{{ $user->first_name }} {{ $user->last_name }}</p>
						</div>
					</a>
				@endforeach
			</div>

			@if(Auth::user() and $startup->hasMember(Auth::user()))
				@if($startup->hasPendingInvitationFrom(Auth::user()))
					Your request is still been considered, would you like to <a href="{{ route('startup_membership_request_cancel', ['url' => $startup->url]) }}" class="btn btn-xs btn-primary">cancel this request?</a>
				@endif
			@endif
			@include('layouts.partials.flag')
		</div>
	</div>
@stop

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function () {
			$('.member-rating').on('rating.change', function (event, value) {
				rate($(this).attr('data-id'), 'user', {{ $startup->id }}, 'startup', value);
			});

			@if(Auth::user())
			$('.startup-rating').on('rating.change', function (event, value) {
				rate($(this).attr('data-id'), 'startup', {{ Auth::user()->id }}, 'user', value);
			});
			@endif

			$('.startup-rating-view').rating({
						readonly: true,
						showClear: false,
						showCaption: false,
						hoverEnabled: false,
						size: 'xs'
					});

			function rate(rated_id, rated_type, rated_by_id, rated_by_type, rating) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': "{{ csrf_token() }}"
					}
				});

				$.post("/rating", {
					rated_id: rated_id,
					rated_type: rated_type,
					rated_by_id: rated_by_id,
					rated_by_type: rated_by_type,
					rating: rating
				});
			}
		});

		@if(getenv('APP_ENV') == 'prod')
			mixpanel.track("TalentDetail:View");
		@endif
	</script>
@stop
