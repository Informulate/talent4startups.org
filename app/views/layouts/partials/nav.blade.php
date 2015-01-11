<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('home') }}">Talent4Startups</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li @if (Request::path() === '/') class="active" @endif><a href="{{ route('home') }}"><i class="glyphicons home"></i> Home</a></li>
				<li @if (Request::path() === 'talents') class="active" @endif><a href="{{ route('talents.index') }}"><i class="glyphicons group"></i> Talent</a></li>
				<li @if (Request::path() === 'startups') class="active" @endif><a href="{{ route('startups.index') }}"><i class="glyphicons suitcase"></i> Startups</a></li>
				<li @if (Request::path() === 'about') class="active" @endif><a href="/about"><i class="glyphicons asterisk"></i> About</a></li>
				<li @if (Request::path() === 'contact') class="active" @endif><a href="/contact"><i class="glyphicons circle_question_mark"></i> Contact</a></li>
				<li @if (Request::path() === 'faq') class="active" @endif><a href="/faq"><i class="glyphicons circle_info"></i> FAQ</a></li>
				@if ($currentUser)
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> {{ $currentUser->email }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ route('profile_path', $currentUser->username) }}"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
							<li><a href="{{ route('logout_path') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
							<li><a id="reset-link" href="{{ route('reset_password') }}"><span class="glyphicon glyphicon-warning-sign"></span> Reset Password</a></li>
						</ul>
					</li>
				@else
					<li><a id="login-link" href="{{ route('login_path') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					<li><form><a id="signup-link" href="{{ route('register_path') }}" type="button" class="btn btn-primary navbar-btn"><span class="glyphicon glyphicon-cog"></span> Sign Up</a></form></li>
				@endif
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</nav>
