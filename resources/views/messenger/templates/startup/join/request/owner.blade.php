@extends('messenger.templates.base')
@section('subject')
    {{ $talent->first_name }} {{ $talent->last_name }} has applied to join {{ $startup->name }}.
@endsection

@section('body')
    {!! link_to_route('profile_path', $talent->first_name . ' ' . $talent->last_name, $talent->id) !!} has applied to join {!! link_to_route('startup_profile', $startup->name, $startup->url) !!}.


    {!! link_to_route('startup_profile', 'Click here to approve or reject', $startup->url) !!}
@endsection
