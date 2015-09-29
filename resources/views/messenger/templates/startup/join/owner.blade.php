@extends('messenger.templates.base')
@section('subject')
{{ $talent->first_name }} {{ $talent->last_name }} has joined your startup
@endsection

@section('body')
Hi {{ $recipient->first_name }},
Congratulations, {!! link_to_route('profile_path', $talent->first_name . ' ' . $talent->last_name, $talent->id) !!} has accepted your invitation to join your startup: {!! link_to_route('startup_profile', $startup->name, $startup->url) !!}.  Your team is growing!

A word to the wise: make sure you engage quickly, assign relevant tasks, follow up on deliverables, and provide specific feedback to earn high ratings from your team members. Consistency and integrity can earn you some serious cred.
@endsection
