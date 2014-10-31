@extends('layouts.default')

@section('content')

<div class="row"> <!-- display search fields -->
	{{ Form::open(['route' => 'home','name'=>'project-search-form','id'=>'project-search-form']) }}
		<div class="form-group col-sm-3">
			{{ Form::select('describe', array('Project that Need:Everyone') + $describes, null,['id'=>'describe','class' => 'form-control']); }}
		</div>
		<div class="form-group col-sm-3">
			{{ Form::text('tag', null, ['id'=>'tag','class' => 'form-control']) }}
		</div>
		<div class="form-group col-sm-3">
			{{ Form::button('Search', ['id'=>'search-button','class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div> <!-- display search fields ends -->

<div id="project-container">
	@include('project.index-project')
</div>
<script>

        $("document").ready(function(){
			// search projects
			 function findProjects(page){
                var describe = $("#describe").val();
                var tag = $("#tag").val();
                var dataString = 'describe='+describe+'&tag='+tag;
                $.ajax({
                    type: "POST",
                    url : "project/findProjects?page="+page,
                    data : dataString,
                    success : function(data){
                        console.log(data);
						$('#project-container').html(data)
                    }
                },"html");
			}
				$('#search-button').on('click',findProjects);

				//pagination
				$(document).on('click', '.pagination a', function (e) {
					e.preventDefault();
					findProjects($(this).attr('href').split('page=')[1]);
				});

        });//end of document ready function
    </script>
@stop
