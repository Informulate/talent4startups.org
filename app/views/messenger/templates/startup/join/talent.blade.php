@section('subject')
You have joined {{ $startup->name }}.
@endsection

@section('body')
You have joined {{ link_to_route('startup_profile', $startup->name, $startup->url) }}.
@endsection
