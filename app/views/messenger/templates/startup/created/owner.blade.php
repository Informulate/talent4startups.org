@section('subject')
{{ $startup->name }} has been created!
@endsection

@section('body')
Head over to your {{ link_to_route('startup_profile', 'Startup Profile', $startup->url) }} check things out!
@endsection