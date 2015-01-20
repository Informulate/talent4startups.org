<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/t4s-identity.png') }}" style="width: 75px; height: 75px;" alt=""/></a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li @if (Request::path() === '/') class="active" @endif><a href="{{ route('home') }}"><i class="glyphicons glyphicons-home"></i> Home</a></li>
				<li @if (Request::path() === 'talents') class="active" @endif><a href="{{ route('talents.index') }}"><i class="glyphicons glyphicons-group"></i> Talent</a></li>
				<li @if (Request::path() === 'startups') class="active" @endif><a href="{{ route('startups.index') }}"><i class="glyphicons glyphicons-lightbulb"></i> Startups</a></li>
				<li @if (Request::path() === 'about') class="active" @endif><a href="/about"><i class="glyphicons glyphicons-asterisk"></i> About</a></li>
				<li @if (Request::path() === 'contact') class="active" @endif><a href="/contact"><i class="glyphicons glyphicons-circle-question-mark"></i> Contact</a></li>
				<li @if (Request::path() === 'faq') class="active" @endif><a href="/faq"><i class="glyphicons glyphicons-circle-info"></i> FAQ</a></li>
				<li @if (Request::path() === 'faq') class="active" @endif><a href="/knowledge-base"><i class="glyphicons glyphicons-book-open"></i> Knowledge Base</a></li>
				@if ($currentUser)
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						    <i class="glyphicons @if ($currentUser->newMessagesCount() > 0)  glyphicons-user-asterisk @else glyphicons-user @endif"></i>
						    {{ $currentUser->email }}
						    @if ($currentUser->newMessagesCount() > 0)  <span class="btn-xs btn btn-info"><strong>{{ $currentUser->newMessagesCount() }}</strong></span> @endif
						    <span class="caret"></span>
                        </a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ route('profile_path', $currentUser->username) }}"><i class="glyphicons glyphicons-user"></i> My Profile</a></li>
							<li>
							    <a href="{{ route('messages') }}"><i class="glyphicon glyphicons-message-new"></i> Messages @if ($currentUser->newMessagesCount() > 0)  ({{ $currentUser->newMessagesCount() }}) @endif</a>

                            </li>
							<li><a href="{{ route('logout_path') }}"><span class="glyphicons glyphicons-log-out"></span> Logout</a></li>
							<li><a id="reset-link" href="{{ route('reset_password') }}"><span class="glyphicons glyphicons-warning-sign"></span> Reset Password</a></li>
						</ul>
					</li>
				@else
					<li><a id="login-link" href="{{ route('login_path') }}"><span class="glyphicons glyphicons-log-in"></span> Login</a></li>
					<li><form><a id="signup-link" href="{{ route('register_path') }}" type="button" class="btn btn-primary navbar-btn"><span class="glyphicons glyphicons-cog"></span> Sign Up</a></form></li>
				@endif
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</nav>
