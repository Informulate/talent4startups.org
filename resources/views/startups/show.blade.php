@extends('app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>{{ $startup->name }}</h1>
			@if($startup->tagline)
				<h5 class="text-muted">{{ $startup->tagline }}</h5>
			@endif

			<div class="pull-right">
				@include('layouts.partials.socialshare')
			</div>
			@if($startup->hasMember(Auth::user()))
				<p><input data-id="{{ $startup->id }}" type="number" class="rating startup-rating" min=0 max=5 step=0.5 data-size="xs" value="{{ $startup->rating() }}"></p>
			@else
				<p><input data-id="{{ $startup->id }}" type="number" class="startup-rating-view" value="{{ $startup->rating() }}" }}></p>
			@endif

			@if ($startup->image)
				<div class="profile-image-lg"
					 style="background-image: url('/images/upload/{{ $startup->image }}')"></div>
				<div class="clearfix"></div>
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

			<div>
				@foreach($startup->tags as $tag)
					<span class="badge">{{ $tag->name }}</span> &nbsp;
				@endforeach
			</div>

			<p>{{ $startup->description }}</p>

			@if(Auth::user() and $startup->hasMember(Auth::user()))
				@if($startup->hasPendingInvitationFrom(Auth::user()))
					Your request is still been considered, would you like to <a href="{{ route('startup_membership_request_cancel', ['url' => $startup->url]) }}" class="btn btn-default">cancel this request?</a>
				@endif
			@endif

			@if(Auth::user() and $startup->owner->id != Auth::id() and false === $startup->hasPendingInvitationFrom(Auth::user()) and false == $startup->hasMember(Auth::user()))
				<a class="btn btn-primary" href="{{ route('startup_membership_request', ['url' => $startup->url]) }}">Join this startup</a>
			@endif

		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-8">
					@if(Auth::user() and $startup->owner->id == Auth::id())
						<a class="btn btn-primary btn-xs pull-right" href="{{ route('startups.edit', $startup->url) }}">Edit Startup</a>
						<h2>Member requests</h2>

						@foreach($requests as $user)
							<div>
								<a href="{{ route('profile_path', $user->id) }}"><img class="img-circle img-responsive" src="{{ $user->avatar() }}?s=64&d=mm" alt="" width="64" height="64"/> {{ $user->first_name }} {{ $user->last_name }}
									({{ $user->profile->skill->name }})
								</a> <a class="btn btn-primary btn-xs" href="{{ route('startup_membership_update', ['startup' => $startup->url, 'userId' => $user->id, 'action' => 'approve']) }}">Approve</a>
								<a class="btn btn-primary btn-xs" href="{{ route('startup_membership_update', ['startup' => $startup->url, 'userId' => $user->id, 'action' => 'reject']) }}">Reject</a>
							</div>
						@endforeach

					@endif

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
							<p>
								{{ $need->description }}
							</p>

							<p class="text-muted">
								Commitment: {{ $need->commitment }}
							</p>
						</div>
					@endforeach
				</div>

				<div class="col-md-4">
					<h2>Startup Contributors</h2>

					<div class="row contributor">
						<a href="{{ route('profile_path', $startup->owner->id) }}">
							<div class="col-xs-4">
								<img class="img-circle img-responsive" src="{{ $startup->owner->avatar() }}?s=150&d=mm" alt="" width="150" height="150"/>
							</div>
							<div class="col-xs-8">
								{{ $startup->owner->first_name }} {{ $startup->owner->last_name }}
								<br/> {{ $startup->owner->profile->skill->name }}
								<strong>owner</strong>
							</div>
						</a>
					</div>
					@foreach($members as $user)
						<div class="row contributor">
							<a href="{{ route('profile_path', $user->id) }}">
								<div class="col-xs-4">
									<img class="img-circle img-responsive" src="{{ $user->avatar() }}?s=150&d=mm" alt="" width="150" height="150"/>
								</div>
								<div class="col-xs-8">
									{{ $user->first_name }} {{ $user->last_name }}
									<br/> {{ $user->profile->skill->name }}
									@if ($startup->owner->id == $user->id)
										<strong>owner</strong>
									@endif
								</div>
							</a>
						</div>
						<div class="row contributor">
							<div class="col-xs-12">
								<input data-id="{{ $user->id }}" type="number" class="rating member-rating" min=0 max=5 step=0.5 data-size="xs" value="{{ $user->rating() }}" @if(Auth::user() and $startup->owner->id != Auth::id()) disabled=true @endif />
							</div>
						</div>
					@endforeach
				</div>
			</div>
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
	</script>
@stop
