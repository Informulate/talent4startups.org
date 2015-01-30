@section('subject')
You have been invited to be a part of {{ $startup->name }}.
@endsection

@section('body')
You have been invited to be a part of {{ link_to_route('startup_profile', $startup->name, $startup->url) }}.
@endsection