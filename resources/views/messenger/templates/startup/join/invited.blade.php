@extends('messenger.templates.base')
@section('subject')
    You have been invited to be a part of {{ $startup->name }}.
@endsection

@section('body')
    Good job, you have been invited to apply to {!! link_to_route('startup_profile', $startup->name, $startup->url) !!}. If you like what you see, apply early to beat out other applicants.

    Remember to come prepared to talk about how your skills can apply to the project's specific needs. Hope you get it!
@endsection
