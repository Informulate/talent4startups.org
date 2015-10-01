@if (count($errors) > 0)
	<script type="text/javascript">
		var errors = '';
		@foreach ($errors->all() as $error)
			errors += '{{ $error }} \n';
		@endforeach

		sweetAlert("There were some problems...", errors, "error");
	</script>
@endif
<script type="text/javascript">
	$(document).ready(function() {
		$('#email-form-link').on('click', function(event){
			event.preventDefault();
			$('#email-form').slideDown("slow");
		})
	});
</script>
