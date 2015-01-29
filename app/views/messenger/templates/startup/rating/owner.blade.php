@section('subject')
{{ $startup->name }} has a new rating
@endsection

@section('body')
{{ link_to_route('startup_profile', $startup->name, $startup->url) }} Profile
@endsection