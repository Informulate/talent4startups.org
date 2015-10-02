<nav id="header-nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('home') }}"><img id="navbar-logo" src="{{ asset('images/logo.png') }}" alt=""/></a>
		</div>
		@section('navbar')
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li @if (Request::path() === '/') class="active" @endif><a href="{{ route('home') }}">Home</a></li>
				<li @if (Request::path() === 'talents') class="active" @endif><a href="{{ route('talents.index') }}">Browse Talent</a></li>
				<li @if (Request::path() === 'startups') class="active" @endif><a href="{{ route('startups.index') }}">Browse Startups</a></li>
				<li @if (Request::path() === 'about') class="active" @endif><a href="/about">About</a></li>
				@if (Auth::user())
					<li @if (Request::path() === 'discussions') class="active" @endif><a href="/discussions/1-threads">Discussions</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							{{ Auth::user()->email }} @if (count(Auth::user()->getNewMessages()) + count(Auth::user()->getNewNotifications()) > 0) <span class="btn-xs btn btn-primary"><strong>{{ count(Auth::user()->getNewMessages()) + count(Auth::user()->getNewNotifications()) }}</strong></span> @endif <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ route('profile_path', Auth::user()->id) }}"><i class="glyphicons glyphicons-user"></i> My Profile</a></li>
							<li><a href="{{ route('messages') }}"><i class="glyphicons glyphicons-message-new"></i> Messages @if (count(Auth::user()->getNewMessages()) > 0) ({{ count(Auth::user()->getNewMessages()) }}) @endif</a></li>
							<li><a href="{{ route('messages') }}?filter=notifications"><i class="glyphicons glyphicons-wifi-alt"></i> Notifications @if (count(Auth::user()->getNewNotifications()) > 0) ({{ count(Auth::user()->getNewNotifications()) }}) @endif</a></li>
							<li><a href="/auth/logout"><span class="glyphicons glyphicons-log-out"></span> Logout</a></li>
							@if (Auth::user()->authType == 'local')
                            <li><a id="reset-link" href="{{ route('reset_password') }}"><span class="glyphicons glyphicons-warning-sign"></span> Reset Password</a></li>
						    @endif
                        </ul>
					</li>
				@else
					<li><a id="login-link" href="/auth/login">Login</a></li>
					<li><a id="signup-link" href="/auth/register">Sign Up</a></li>
				@endif
			</ul>
		</div>
		@show
		<!--/.nav-collapse -->
	</div>
</nav>
