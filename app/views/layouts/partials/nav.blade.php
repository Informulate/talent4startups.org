<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Talent4Startups</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li @if (Request::path() === '/') class="active" @endif><a href="{{ route('home') }}">Home</a></li>
				<li @if (Request::path() === 'talents') class="active" @endif><a href="#talents">Talents</a></li>
				<li @if (Request::path() === 'projects') class="active" @endif><a href="#projects">Projects</a></li>
				<li @if (Request::path() === 'about') class="active" @endif><a href="#about">About</a></li>
				<li @if (Request::path() === 'contact') class="active" @endif><a href="#contact">FAQ</a></li>
				@if ($currentUser)
					<li><a href="{{ route('logout_path') }}"><span class="glyphicon glyphicon-log-out"></span> Logout :: {{ $currentUser->email }}</a></li>
				@else
					<li><a id="login-link" href="{{ route('login_path') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					<li><form><a id="signup-link" href="{{ route('register_path') }}" type="button" class="btn btn-primary navbar-btn"><span class="glyphicon glyphicon-cog"></span> Sign Up</a></form></li>
				@endif
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</nav>
