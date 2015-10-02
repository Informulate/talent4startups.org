@extends('messenger.templates.base')
@section('subject')
Congratulations, your application to join {{ $startup->name }} has been accepted.
@endsection

@section('body')
Congratulations, your application to join  {!! link_to_route('startup_profile', $startup->name, $startup->url) !!} has been accepted. Make room on your schedule!

To make the most of it: brush up on your skills, communicate often, set realistic expectations, and focus on quality to earn high ratings.
@endsection
