@extends('messenger.templates.base')
@section('subject')
You are no longer part of the project: {{ $startup->name }}
@endsection

@section('body')
Hi {{ $recipient->first_name }},
FYI, you are no longer part of the {!! link_to_route('startup_profile', $startup->name, $startup->url) !!} team. All things come to an end. :(

Ratings are a crucial part of T4S, and helps to maintain a vibrant community. So please take a minute to rate {{ $startup->owner->first_name }}'s performance.
@endsection
