@extends('master')

@section('title', 'EditTemplate page')

@section('content')
	  
	<div class="form-group row">
  		<div class="col-sm-2"></div>
  		<div class="col-sm-10">
	    
	    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post" >
	    <h4>{{}}</h4>
	       <a href="{{ url('CMSindex') }}" class="btn btn-warning btn-sm" style="margin-left:700px;margin-top:10px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back
   		   </a>
  		<div class="row">	  	
	  		<div class="col-sm-12">
	      	<?php echo htmlspecialchars_decode($pages->content);?>
	    	</div>
		</div>
    </form>
  	</div>
	    
	</div>    
	    
	<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
	<script>
	    CKEDITOR.replace( 'summary-ckeditor' );
	</script>
@endsection
