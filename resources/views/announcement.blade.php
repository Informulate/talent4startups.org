@extends('app')

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<h2>{{ $announcement->title }}</h2>
			{!! $announcement->message !!}
			<p class="accept">
				<a class="btn btn-primary" href="{{ route('accept_announcement') }}">Accept &amp; Continue</a>
			</p>
		</div>
	</div>
@endsection
