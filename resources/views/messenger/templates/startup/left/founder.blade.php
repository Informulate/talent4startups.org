@extends('messenger.templates.base')
@section('subject')
    {{ $talent->first_name }} {{ $talent->last_name }} has left {{ $startup->name }}
@endsection

@section('body')
    Hi {{ $recipient->first_name }},

    FYI, {!! link_to_route('profile_path', $talent->first_name . ' ' . $talent->last_name, $talent->id) !!} has left your project: {!! link_to_route('startup_profile', $startup->name, $startup->url) !!}. All things come to an end. :(

    Ratings are a crucial part of T4S, and helps to maintain a vibrant community. Please take a minute to rate {{ $recipient->first_name }}'s performance.
@endsection
