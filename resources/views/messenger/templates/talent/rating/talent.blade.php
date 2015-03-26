@extends('messenger.templates.base')
@section('subject')
You have a new rating
@endsection

@section('body')
Check it out on your {{ link_to_route('profile_path', 'Profile', $recipient->id) }}.
@endsection
