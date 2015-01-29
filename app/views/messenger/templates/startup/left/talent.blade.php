@section('subject')
You have left {{ $startup->name }}
@endsection

@section('body')
You have left {{ link_to_route('startup_profile', $startup->name, $startup->url) }}
@endsection