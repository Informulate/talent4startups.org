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
							@include('layouts.partials.type')
						</div>
						<div class="row">
							<div class="col-sm-12">
								<input id="agree" type="checkbox" value="agree"/> I agree to the Terms of Use and am ready to get started.<br/>
								<button id="register-linkedin" class="btn btn-primary">LinkedIn</button><br/>
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
			event.preventDefault();
			console.log('WTF CARAJO');

			var $error = validateRegistration();

			if ($error == 0) {
				//No errors, form is ready to submit
				var $type = getType();
				$('<form method="GET" action="{{ route("register_path") }}?type='+$type+'"><input type="hidden" name="type" id="type" value="'+$type+'"></form>').appendTo('body').submit();
			}
		});

		// Register via Linekdin
		$('#register-linkedin').on('click', function(event) {
			var $error = validateRegistration();
			if($error==0){
			//No errors, form is ready to submit

			var $type = getType();

			$('<form method="GET" action="{{ route("register_linkedin") }}"><input type="hidden" name="type" id="type" value="'+$type+'"></form>').appendTo('body').submit();
			}
		});

		/*
		* validate form before submit
		*/
		function validateRegistration(){
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
			return $error;
		}

		/*
		* Identify user is talent or startup
		*/
		function getType(){
		if($('#talent').hasClass('text-primary')){
				var $type = 'talent';
			}else{
				var $type = 'startup';
			}
			return $type;
		}
	});
</script>
@endif
