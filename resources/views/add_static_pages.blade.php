@extends('master')
@section('title', 'Add StaticPages page')
@section('content')
	  
<div class="form-group row">
  	<div class="col-sm-2"></div>
  	<div class="col-sm-10">
		<h2>CMS</h2>

	   	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="{{route('storeCMS')}}">
	    	{{csrf_field()}}
	    	@if (session('success'))
			<div class="alert alert-danger" role="alert">
	            {{ session('success')}}
	        </div>
	    	@endif
			<div class="pull-right"> 
	      	 	<a href="{{ url('CMSindex') }}" class="btn btn-warning btn-sm" style="margin-left:750px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back
	       		</a>
			</div>
	    	<div class="row">

	    		<div class="col-xs-1"></div>
	    		<div class="col-xs-10">

	    		<label for="template_name" class="control-label">{{ 'Name' }}</label>
				<input class="form-control" name="name" type="text"  value="">
				{!! $errors->first('name', '<p class="help-block" style="color:red;">:message</p>') !!}
				<br>
				<label for="template_name" class="control-label">{{ 'Title' }}</label>
	  			<input class="form-control" name="title" type="text">
	  			{!! $errors->first('title', '<p class="help-block" style="color:red;">:message</p>') !!}
				<br>
	    		<label for="template_name" class="control-label">{{ 'Page content' }}</label>
				<textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea>
				{!! $errors->first('summary-ckeditor', '<p class="help-block" style="color:red;">:message</p>') !!}
				<br>
				<button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
				</div>
	       
	    		<div class="col-xs-1"></div>
	    	</div>
		</form>
	</div> 
</div>
	
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );
    config.colorButton_enableAutomatic = false;
</script>
@endsection

