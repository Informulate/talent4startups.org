@extends('layouts.master')

@section('css')
<style type="text/css">
	.breadcrumb {
		margin-top: 40px;
	}
	#profile {
		margin-right: 10px;
	}
	#instructions {
		display: block;
	}
</style>
@stop

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li class="active">Setup Profile</li>
		<li><a href="#">Startup Profile</a></li>
		<li><a href="#">Publish</a></li>
	</ol>
	<div class="row">
		<div class="col-sm-12">
			<h1>About you <small>Fields marked with * are required</small></h1>
		</div>
	</div>
	<form role="form">
		<div class="row">
			<div class="col-md-9">
				<div class="row">
					<div class="form-group col-md-6">
						<label for="exampleInputEmail1">Your location *</label>
						<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Your location">
					</div>
					<div class="form-group col-md-6">
						<label for="age-range">Age Range</label>
						<select name="ageRange" id="age-range" class="form-control">
							<option value="">36-55 years old</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<label for="age-range">I'm best described as a</label>
						<select name="ageRange" id="age-range" class="form-control">
							<option value="">Developer</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="exampleInputEmail1">Industry</label>
						<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Industry">
					</div>
					<div class="form-group col-md-4">
						<label for="exampleInputEmail1">Industry Experience</label>
						<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Industry Experience">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<label for="summary">Summary about who you are</label>
						<textarea name="summary" id="summary" rows="10" class="form-control"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-sm-12">
							<label for="exampleInputFile">Profile Image</label>
						</div>
						<div class="col-sm-12">
							<img id="profile" data-src="holder.js/100x100/auto" alt="Generic placeholder image" alt="thumb" class="img-thumbnail pull-left">
							<input type="file" id="exampleInputFile">
							<p class="help-block">.jpg, .jpeg, .png, .gif images only. Maximum file size 1mb.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div id="instructions" class="popover right">
					<div class="arrow"></div>
					<h3 class="popover-title">Instructions</h3>
					<div class="popover-content">
						<p>In order to match you with the best talent we need to know a few things about you and your idea/company.</p>
					</div>
				</div>
			</div>
		</div>
		<hr/>
		<button type="submit" class="btn btn-primary">Continue</button>
	</form>
</div>
@stop
