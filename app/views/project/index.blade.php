@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6 col-lg-12">
			<h1>Projects</h1>

			{{ $projects->links() }}
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Actions</th>
              <th>Name</th>
              <th>Description</th>
              <th>Created</th>
              <th>Updated</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
            	<th>Actions</th>
              <th>Name</th>
              <th>Description</th>
              <th>Created</th>
              <th>Updated</th>
            </tr>
        </tfoot>
        <tbody>
        	@foreach ( $projects as $project )
        		<tr>
        			<td class="icon">
                <a class="delete" href="#" id="{{{ $project->id }}}"><i class="fa fa-eraser"></i></a>
                <a href=""><i data-projectid="{{{ $project->id }}}" data-url="{{{ action( 'ProjectController@show', [ 'projectid' => $project->id ] ) }}}" class="fa fa-info-circle"></i><a/>
              </td>
							<td id="name">{{ $project->name }}</td>
							<td id="description">{{ Str::limit( $project->description, 50 ) }}</td>
							<td>{{ $project->created_at }}</td>
							<td>{{ $project->updated_at }}</td>
						</tr>
					@endforeach
        </tbody>
      </table>
      {{ $projects->links() }}

			@include('layouts.partials.errors')
		</div>
	</div>
@stop