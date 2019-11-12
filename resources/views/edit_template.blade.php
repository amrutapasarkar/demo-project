@extends('master')
@section('title', 'EditTemplate page')
@section('content')
	  
<div class="form-group row">
    <div class="col-sm-2"></div>
  	<div class="col-sm-10">
	    <h2>Edit Template</h2>
	    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="{{url('updateTemplate/'.$edittemplate->id)}}">
	     {{csrf_field()}}
    	<div class="pull-right"> 
	       <a href="{{ route('indextemplate') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back
   		   </a>
    	</div>
	    <div class="row">
  	  <div class="col-xs-1"></div>
  	  <div class="col-xs-10">

	    <label for="template_name" class="control-label">{{ 'Name' }}</label>
	    <input class="form-control" name="template_name" type="text" id="subject" value="{{$edittemplate->email_template_name}}" >
      {!! $errors->first('template_name', '<p class="help-block" style="color:red;">:message</p>') !!}
      <br>

      <label for="template_name" class="control-label">{{ 'Mail Subject' }}</label>
      <input class="form-control" name="email_subject" type="text" id="subject" value="{{$edittemplate->email_subject}}" >
      {!! $errors->first('email_subject', '<p class="help-block" style="color:red;">:message</p>') !!}
	    <br>
      <label for="template_name" class="control-label">{{ 'Template content' }}</label>
	    <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor">{{$edittemplate->email_template_content}}</textarea>
      {!! $errors->first('summary-ckeditor', '<p class="help-block" style="color:red;">:message</p>') !!}
	    <br>
      <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
      </div>
      <div class="col-xs-1"></div>
      </div>
	    </form>
	  </div>
    <br>
    <br>
	<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
  </script>
@endsection

