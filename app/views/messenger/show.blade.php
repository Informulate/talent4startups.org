@extends('layouts.default')

@section('content')
    <div class="col-md-6">
        <div class="pull-right actions">
           @if($thread->isUnread($currentUserId))<a href="{{ route('messages.markRead', $thread->id) }}" class="btn btn-warning pull-right">Mark Read</a> @endif
           <a href="{{ route('messages.delete', $thread->id) }}" class="btn btn-danger pull-right">Delete</a>
        </div>
        <h1>{{$thread->subject}}</h1>

        @foreach($messages as $message)
            <div class="media">
                <a class="pull-left" href="#">
                    <img src="//www.gravatar.com/avatar/{{md5($message->user->email)}}?s=64&d=wavatar" alt="{{$message->user->profile->first_name}}" class="img-circle">
                </a>
                <div class="media-body">
                    <h5 class="media-heading"><a href="{{ route('profile_path', $message->user->username) }}">{{$message->user->profile->first_name}} {{$message->user->profile->last_name}}</a></h5>
                    <p>{{$message->body}}</p>
                    <div class="text-muted"><small>Posted {{$message->created_at->diffForHumans()}}</small></div>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-sm-12">
                {{ $messages->links() }}
            </div>
        </div>

        <h2>Reply</h2>
        {{Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT'])}}
        <!-- Message Form Input -->
        <div class="form-group">
            {{ Form::textarea('message', null, ['class' => 'form-control']) }}
        </div>

        @if($users->count() > 0)
        <div class="checkbox">
            @foreach($users as $user)
                <label title="{{$user->profile->first_name}} {{$user->profile->last_name}}"><input type="checkbox" name="recipients[]" value="{{$user->id}}">{{$user->profile->first_name}}</label>
            @endforeach
        </div>
        @endif

        <!-- Submit Form Input -->
        <div class="form-group">
            {{ Form::submit('Submit', ['class' => 'btn btn-primary form-control']) }}
        </div>
        {{Form::close()}}
    </div>
@stop
