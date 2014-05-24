@extends('layouts.master')

@section('content')
	<div class="container">
		<h1>Projects</h1>
		@include('angularjs/projects')
		<div class="row">
			<div class="col-xs-12">
				<ul class="pager">
					<li class="previous"><a href="#">&larr; Previous</a></li>
					<li class="next"><a href="#">Next &rarr;</a></li>
				</ul>
			</div>
		</div>
	</div>
@stop
