@if( Auth::user() and Auth::user()->announcement() and Route::currentRouteName() != 'announcement' and Route::currentRouteName() != 'accept_announcement')
	<div class="container">
		<div id="announcement" class="alert alert-{{ Auth::user()->announcement()->type }} alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>{{ Auth::user()->announcement()->title }}!</strong> {!! Auth::user()->announcement()->message !!}
		</div>
	</div>
@endif
