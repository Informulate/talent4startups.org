@extends('layouts.default')

@section('content')
    <h3>My Messages</h3>
    <div class="col-md-8">
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('error_message')}}
        </div>
    @endif
    <p></p><p></p>
    <p><a href="{{route('messages.create')}}" class="btn btn-info">New Message</a></p>
    @if(count($threads) > 0)
        @foreach($threads as $thread)
        <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
        <div class="media alert {{$class}}">
            <a class="pull-left" href="#">
                <img src="//www.gravatar.com/avatar/{{md5($thread->latestMessage()->user->email)}}?s=64&d=wavatar" alt="{{$thread->latestMessage()->user->profile->first_name}} {{$thread->latestMessage()->user->profile->last_name}}" class="img-circle">
            </a>
            <p class="pull-right"> {{ $thread->updated_at->format('M j, Y') }} <br /><small>{{ $thread->updated_at->diffForHumans() }}</small></p>
            <h4 class="media-heading">{{link_to('messages/' . $thread->id, $thread->subject)}}</h4>
            <p>
                @foreach($thread->participantsUsers() as $user)
                    @if ($user->id != $thread->latestMessage()->user->id && (count($thread->messages) > 1)) <strong>{{ $user->profile->first_name }} {{ $user->profile->last_name }}, </strong> @endif
                    @if ($user->id != $thread->latestMessage()->user->id) <strong>{{ $user->profile->first_name }} {{ $user->profile->last_name }} </strong> @endif

                @endforeach
                @if(count($thread->messages) > 1) <strong>{{$thread->latestMessage()->user->profile->first_name}} {{$thread->latestMessage()->user->profile->last_name}}</strong> @endif
                @if(count($thread->messages) > 1) ({{ count($thread->messages) }}) @endif
                @if((count($thread->messages) > 1) && $thread->latestMessage()->user->id == $currentUser->id) <small>(Replied)</small> @endif
            </p>
            {{ Str::words($thread->latestMessage()->body, 50) }}
            <div class="clearfix"></div>
            <div class="pull-right actions">
               @if($thread->isUnread($currentUserId))<a href="{{ route('messages.markRead', $thread->id) }}" class="btn btn-warning pull-right">Mark Read</a> @endif
               <a href="{{ route('messages.delete', $thread->id) }}" class="btn btn-danger pull-right">Delete</a>
            </div>
            <div class="pull-left actions">
                <a href="{{ route('messages.show', $thread->id) }}" class="btn btn-default pull-right">Read More</a>
            </div>
        </div>
        @endforeach
    @else
        <p>Sorry, no threads.</p>
    @endif
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{ $threads->links() }}
        </div>
    </div>
@stop
