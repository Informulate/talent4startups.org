@extends('layouts.default')

@section('content')

<div class="row"> <!-- display search fields -->
	{{ Form::open(['route' => 'home','name'=>'talent-search-form','id'=>'talent-search-form']) }}
		<div class="form-group col-sm-3">
			{{ Form::select('describe', array('Browse:everyone') + $describes, null,['id'=>'describe','class' => 'form-control']); }}
		</div>
		<div class="form-group col-sm-3">
			{{ Form::text('tag', null, ['id'=>'tag','class' => 'form-control']) }}
		</div>
		<div class="form-group col-sm-3">
			{{ Form::button('Search', ['id'=>'search-button','class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div> <!-- display search fields ends -->
<div id="talent-container">
	@include('talent.index-talent')
</div>
<script>
		$("document").ready(function() {
			//search talents
			function requestTalents(page) {
				var describe = $("#describe").val();
				var tag = $("#tag").val();
				var dataString = 'describe='+describe+'&tag='+tag;
				$.ajax({
					type: "POST",
					url : "talent/findTalents?page="+page,
					data : dataString,
					success : function(data) {
						$('#talent-container').html(data);
					}
				},"html");
				return false;
			}

			$('#search-button').on('click', requestTalents);

			//pagination
			$(document).on('click', '.pagination a', function (e) {
				e.preventDefault();
				requestTalents($(this).attr('href').split('page=')[1]);
			});
		});//end of document ready function
	</script>
@stop
