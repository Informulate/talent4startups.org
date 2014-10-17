@if (! Auth::check())
<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="tab-content">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<ul class="nav nav-tabs">
						<li id="login-tab-link" class="active"><a href="#login-tab" data-toggle="tab">Login</a></li>
						<li id="signup-tab-link"><a href="#signup-tab" data-toggle="tab">Sign Up</a></li>
					</ul>
					<div class="tab-pane active" id="login-tab">
						@include('layouts.partials.forms.login')
					</div>
					<div class="tab-pane text-center" id="signup-tab">
						<div class="row">
							<div class="col-sm-6">
								<div id="startup">
									<i class="glyphicons group type"></i>
								</div>
								<p>I’m a startup looking for talent</p>
								<p>This text is meant to be treated as fine print. This text is meant to be treated as fine print. This text is meant to be treated as fine print. This text is meant to be treated as fine print.</p>
							</div>
							<div class="col-sm-6">
								<div id="talent">
									<i class="glyphicons user type"></i>
								</div>
								<p>I’m talent looking for a startup</p>
								<p>This text is meant to be treated as fine print. This text is meant to be treated as fine print. This text is meant to be treated as fine print. This text is meant to be treated as fine print.</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<input id="agree" type="checkbox" value="agree"/> I agree to the Terms of Use and am ready to get started.<br/>
								<button class="btn btn-primary">LinkedIn</button><br/>
								<a id="register-email" style="cursor:pointer;">Or sign up with email instead</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$(document).ready(function() {
		// Activate the signup tab
		$('#signup-link').on('click', function(event) {
			event.preventDefault();
			$('#login-tab, #login-tab-link').removeClass('active');
			$('#signup-tab, #signup-tab-link').addClass('active');
			$('#login-modal').modal();
		});
		// Activate the login tab
		$('#login-link').on('click', function(event) {
			event.preventDefault();
			$('#login-tab, #login-tab-link').addClass('active');
			$('#signup-tab, #signup-tab-link').removeClass('active');
			$('#login-modal').modal();
		});

		// User Type Selection feedback
		$('#startup').on('click', function() {
			$('#talent').removeClass('text-primary');
			$(this).addClass('text-primary');
		});

		$('#talent').on('click', function() {
			$('#startup').removeClass('text-primary');
			$(this).addClass('text-primary');
		});

		// Register via email
		$('#register-email').on('click', function(event) {
			var $error=0;
			if (false === $("#agree").is(':checked')) {
				$error++;
				event.preventDefault();
				alert('You must agree to the Terms of Use before getting started!');
			}

			if (false === $('#talent').hasClass('text-primary') && false === $('#startup').hasClass('text-primary')) {
				$error++;
				event.preventDefault();
				alert('Are you a talent or a startup? Click the appropriate icon above!');
			}

			if($error==0){
			//No errors, form is ready to submit
			if($('#talent').hasClass('text-primary')){
				var $userType = 'T';
			}else{
				var $userType = 'S';
			}

			$('<form method="POST" action="{{ route("register_path") }}"><input type="hidden" name="user_type" id="user_type" value="'+$userType+'"></form>').appendTo('body').submit();
			}
		});
	});
</script>
@endif
