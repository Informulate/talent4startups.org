@extends('app')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h1>Welcome OrlandoiX Users <small>to the Talent4Startups OrlandoiX Community</small></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="well well-sm">
				<h4><a href="{{ route('community.discussion') }}">Discussion title</a></h4>
				<p>Discussion description with lorem ipsum blah blah who knows. Also BEER Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna...</p>
				<p class="text-muted small">
					Submitted 6 hours ago by <a href="#">someone@email.dom</a><br/>
					12 comments
				</p>
				<a class="btn btn-primary pull-right" href="{{ route('community.discussion') }}">Read More</a>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="well well-sm">
				<h4><a href="{{ route('community.discussion') }}">Discussion title</a></h4>
				<p>Discussion description with lorem ipsum blah blah who knows. Also BEER Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna...</p>
				<p class="text-muted small">
					Submitted 6 hours ago by <a href="#">someone@email.dom</a><br/>
					12 comments
				</p>
				<a class="btn btn-primary pull-right" href="{{ route('community.discussion') }}">Read More</a>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="well well-sm">
				<h4><a href="{{ route('community.discussion') }}">Discussion title</a></h4>
				<p>Discussion description with lorem ipsum blah blah who knows. Also BEER Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna...</p>
				<p class="text-muted small">
					Submitted 6 hours ago by <a href="#">someone@email.dom</a><br/>
					12 comments
				</p>
				<a class="btn btn-primary pull-right" href="{{ route('community.discussion') }}">Read More</a>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="well well-sm">
				<h4><a href="{{ route('community.discussion') }}">Discussion title</a></h4>
				<p>Discussion description with lorem ipsum blah blah who knows. Also BEER Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna...</p>
				<p class="text-muted small">
					Submitted 6 hours ago by <a href="#">someone@email.dom</a><br/>
					12 comments
				</p>
				<a class="btn btn-primary pull-right" href="{{ route('community.discussion') }}">Read More</a>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="well well-sm">
				<h4><a href="{{ route('community.discussion') }}">Discussion title</a></h4>
				<p>Discussion description with lorem ipsum blah blah who knows. Also BEER Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna...</p>
				<p class="text-muted small">
					Submitted 6 hours ago by <a href="#">someone@email.dom</a><br/>
					12 comments
				</p>
				<a class="btn btn-primary pull-right" href="{{ route('community.discussion') }}">Read More</a>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<a class="btn btn-primary pull-right" href="#">Start a discussion</a>
			<nav class="pull-left">
				<ul class="pagination">
					<li>
						<a href="#" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
					<li><a href="#">1</a></li>
					<li class="active"><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li>
						<a href="#" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="row">
		@for ($i = 0; $i < 12; $i++)
			<div class="col-lg-4">
				<div class="well well-sm">
					<h4><a href="{{ route('community.discussion') }}">Discussion title</a></h4>
					<p>Discussion description with lorem ipsum blah blah who knows. Also BEER Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna...</p>
					<p class="text-muted small">
						Submitted 6 hours ago by <a href="#">someone@email.dom</a><br/>
						12 comments
					</p>
					<a class="btn btn-primary pull-right" href="{{ route('community.discussion') }}">Read More</a>
					<div class="clearfix"></div>
				</div>
			</div>
		@endfor
	</div>
	<div class="row">
		<div class="col-lg-12">
			<nav>
				<ul class="pagination">
					<li>
						<a href="#" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
					<li><a href="#">1</a></li>
					<li class="active"><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li>
						<a href="#" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
@stop
