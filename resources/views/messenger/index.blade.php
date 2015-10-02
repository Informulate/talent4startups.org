@extends('app')

@section('content')
	<style>
		.message {
			margin: 10px;
			border: 1px solid #bbb;
			border-left: 5px solid #bbb;
		}

		.notification {
			border-left: 5px solid #c12e2a;
		}

		#message-menu li.active {
			font-weight: bold;
		}
	</style>
	<div class="row">
		<div class="col-md-2">
			<p><a href="{{route('messages.create')}}" class="btn btn-info">New Message</a></p>
			<ul id="message-menu">
				<li @if (Request::get('filter', 'message') === 'message') class="active" @endif>
					<a href="{{route('messages')}}" class="">Inbox ({{ count(Auth::user()->getNewMessages()) }})</a>
				</li>
				<li @if (Request::get('filter', 'message') === 'notifications') class="active" @endif>
					<a href="{{route('messages')}}?filter=notifications" class="">Notifications ({{ count(Auth::user()->getNewNotifications()) }})</a>
				</li>
			</ul>
		</div>
		<div class="col-md-9">
	        <h3>&nbsp; My Messages</h3>
			@if (Session::has('error_message'))
				<div class="alert alert-danger" role="alert">
					{{Session::get('error_message')}}
				</div>
			@endif
			<div id="preview-pane"></div>
			<p></p>

			<p></p>

			@if(count($threads) > 0)
				@foreach($threads as $thread)
					<?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
					<div class="media alert {{$class}} message {{ $thread->getLatestMessageAttribute()->type }}">
						@if ($thread->getLatestMessageAttribute()->type == 'message')
							<a class="pull-left" href="{{ route('profile_path', $thread->getLatestMessageAttribute()->user->id) }}">
								<img src="{{ $thread->getLatestMessageAttribute()->user->avatar() }}" alt="{{$thread->getLatestMessageAttribute()->user->first_name}} {{$thread->getLatestMessageAttribute()->user->last_name}}" class="img-circle" width="64" height="64">
							</a>
						@endif
						<h4 class="media-heading">{!! link_to('messages/' . $thread->id, $thread->subject) !!}</h4>

						<p class=""> {{ $thread->updated_at->format('M j, Y') }}
							<small>{{ $thread->updated_at->diffForHumans() }}</small>
						</p>
						<p>
							@foreach($thread->participantsUsers() as $user)
								@if ($user->id != $thread->getLatestMessageAttribute()->user->id && (count($thread->messages) > 1))
									<strong>{{ $user->first_name }} {{ $user->last_name }}, </strong>
								@elseif ($user->id != $thread->getLatestMessageAttribute()->user->id)
									<strong>{{ $thread->getLatestMessageAttribute()->user->first_name }} {{ $thread->getLatestMessageAttribute()->user->last_name }} </strong> @endif

							@endforeach
							@if(count($thread->messages) > 1)
								<strong>{{$thread->getLatestMessageAttribute()->user->first_name}} {{$thread->getLatestMessageAttribute()->user->last_name}}</strong> @endif
							@if(count($thread->messages) > 1) ({{ count($thread->messages) }}) @endif
							@if((count($thread->messages) > 1) && $thread->getLatestMessageAttribute()->user->id == Auth::user()->id)
								<small>(Replied)</small> @endif
						</p>
						<p class="text-muted">{{ str_limit(strip_tags(str_replace(array('&lt;', '&gt;'), array('<', '>'), $thread->getLatestMessageAttribute()->body)), 15) }}</p>

						<div class="clearfix"></div>
						<div class="pull-right actions">
							@if($thread->isUnread($currentUserId))
								<a href="{{ route('messages.markRead', $thread->id) }}" class="btn btn-warning pull-right">Mark
									Read</a>

							@else
								<a href="{{ route('messages.unread', $thread->id) }}" class="btn btn-default pull-right">Mark
									Unread</a>
							@endif
						</div>
						<div class="pull-left actions">
							<a href="{{ route('messages.show', $thread->id) }}" class="btn btn-default pull-right read-more">Read
								More</a>
						</div>
					</div>
				@endforeach
			@else
				<p>Sorry, no threads.</p>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			{!! $threads->render() !!}
		</div>
	</div>
@endsection

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function () {
			$('.read-more').on('click', function (event) {
				event.preventDefault();
				$('#preview-pane').html('Loading...');
				$('#preview-pane').load($(this).attr('href'));
				$('div.message').removeClass('bg-warning');
				$(this).parents('div.message').addClass('bg-warning');
			});
		});
	</script>
@endsection
