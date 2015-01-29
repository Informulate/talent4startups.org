@extends('layouts.default')

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
</style>
    <h3>My Messages</h3>
    <div class="col-md-12" id="preview-pane"></div>
    <div class="col-md-12">
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('error_message')}}
        </div>
    @endif
    <p></p><p></p>
    <p><a href="{{route('messages.create')}}" class="btn btn-info">New Message</a></p>
        <div class="row"></div>
    @if(count($threads) > 0)
        @foreach($threads as $thread)
        <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
        <div class="media alert {{$class}} message {{ $thread->latestMessage()->type }}">
            @if ($thread->latestMessage()->type == 'message')
            <a class="pull-left" href="#">
                <img src="//www.gravatar.com/avatar/{{md5($thread->latestMessage()->user->email)}}?s=64&d=wavatar" alt="{{$thread->latestMessage()->user->profile->first_name}} {{$thread->latestMessage()->user->profile->last_name}}" class="img-circle">
            </a>
            @endif
            <h4 class="media-heading">{{link_to('messages/' . $thread->id, $thread->subject)}}</h4>
            <p class=""> {{ $thread->updated_at->format('M j, Y') }} <small>{{ $thread->updated_at->diffForHumans() }}</small></p>
            <p>
                @foreach($thread->participantsUsers() as $user)
                    @if ($user->id != $thread->latestMessage()->user->id && (count($thread->messages) > 1)) <strong>{{ $user->profile->first_name }} {{ $user->profile->last_name }}, </strong> @endif
                    @if ($user->id != $thread->latestMessage()->user->id) <strong>{{ $user->profile->first_name }} {{ $user->profile->last_name }} </strong> @endif

                @endforeach
                @if(count($thread->messages) > 1) <strong>{{$thread->latestMessage()->user->profile->first_name}} {{$thread->latestMessage()->user->profile->last_name}}</strong> @endif
                @if(count($thread->messages) > 1) ({{ count($thread->messages) }}) @endif
                @if((count($thread->messages) > 1) && $thread->latestMessage()->user->id == $currentUser->id) <small>(Replied)</small> @endif
            </p>
            <p class="text-muted">{{ Str::words($thread->latestMessage()->body, 15) }}</p>
            <div class="clearfix"></div>
            <div class="pull-right actions">
                @if($thread->isUnread($currentUserId))
                    <a href="{{ route('messages.markRead', $thread->id) }}" class="btn btn-warning pull-right">Mark Read</a>

                @else
                    <a href="{{ route('messages.unread', $thread->id) }}" class="btn btn-default pull-right">Mark Unread</a>
               @endif
            </div>
            <div class="pull-left actions">
                <a href="{{ route('messages.show', $thread->id) }}" class="btn btn-default pull-right read-more">Read More</a>
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
