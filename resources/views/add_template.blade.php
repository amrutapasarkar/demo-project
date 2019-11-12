@extends('master')
@section('title', 'EditTemplate page')
@section('content')
	  
<div class="form-group row">
	<div class="col-sm-2"></div>
	<div class="col-sm-10">
    	<h2>Add New Template</h2>

	   <form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="{{route('storeTemplate')}}">
	    	{{csrf_field()}}
	    	@if (session('success'))
				<div class="alert alert-danger" role="alert">
                {{ session('success')}}
            	</div>
        	@endif
    		<div class="pull-right"> 
	       		<a href="{{ route('indextemplate') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back
	       		</a>
    		</div>
    		<div class="row">

    			<div class="col-xs-1"></div>
    			<div class="col-xs-10">

    				<label for="template_name" class="control-label">{{ 'Name' }}</label>
					<input class="form-control" name="template_name" type="text"  value="" >
					{!! $errors->first('template_name', '<p class="help-block" style="color:red;">:message</p>') !!}
					<br>
					<label for="template_name" class="control-label">{{ 'Template key' }}</label>
  					<input class="form-control" name="template_key" type="text">
  					{!! $errors->first('template_key', '<p class="help-block" style="color:red;">:message</p>') !!}
					<br>
					<label for="template_name" class="control-label">{{ 'Mail Subject' }}</label>
  					<input class="form-control" name="email_subject" type="text">
  					{!! $errors->first('email_subject', '<p class="help-block" style="color:red;">:message</p>') !!}
					<br>
    				<label for="template_name" class="control-label">{{ 'Template content' }}</label>
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

