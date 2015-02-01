@extends('messenger.templates.base')
@section('subject')
{{ $talent->profile->first_name }} {{ $talent->profile->last_name }} has applied to join {{ $startup->name }}.
@endsection

@section('body')
{{ link_to_route('profile_path', $talent->profile->first_name . ' ' . $talent->profile->last_name, $talent->username) }} has applied to join {{ link_to_route('startup_profile', $startup->name, $startup->url) }}.
@endsection