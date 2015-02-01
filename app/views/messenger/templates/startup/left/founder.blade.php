@section('subject')
{{ $talent->profile->first_name }} {{ $talent->profile->last_name }} has left {{ $startup->name }}
@endsection

@section('body')
Hi {{ $recipient->profile->first_name }},

FYI, {{ link_to_route('profile_path', $talent->profile->first_name . ' ' . $talent->profile->last_name, $talent->username) }} has left your project: {{ link_to_route('startup_profile', $startup->name, $startup->url) }}. All things come to an end. :(

Ratings are a crucial part of T4S, and helps to maintain a vibrant community. Please take a minute to rate {{ $recipient->profile->first_name }}'s performance.
@endsection