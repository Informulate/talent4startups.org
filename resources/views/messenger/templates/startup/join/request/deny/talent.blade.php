@extends('messenger.templates.base')
@section('subject')
T4S: About your request to join {{ $startup->name }}
@endsection

@section('body')
Unfortunately, your request to join {{ $startup->name }} has been denied. :(

But hey, Rome wasn't built in a day! Interviewing and making a great first impression is a valuable skill to have. Experiment with different approaches to see what works. Founders love to hear about how your skills can match their specific needs. So try, try and you will succeed.
@endsection
