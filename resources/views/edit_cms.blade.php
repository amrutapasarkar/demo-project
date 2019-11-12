@extends('master')
@section('title', 'EditTemplate page')
@section('content')
	  
<div class="form-group row">
  <div class="col-sm-2"></div>
  <div class="col-sm-10">
  <h2>Edit Page</h2>
  <form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="{{url('updateCMS/'.$pages->id)}}">
    {{csrf_field()}}
    {{ method_field('PATCH') }}
    <div class="pull-right"> 
      <a href="{{ url('CMSindex') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back
      </a>

    </div>
    <div class="row">

    <div class="col-xs-1"></div>
    <div class="col-xs-10">
      <label for="template_name" class="control-label">{{ 'Name' }}</label>
      <input class="form-control" name="name" type="text" id="subject" value="{{$pages->name}}" >
      {!! $errors->first('name', '<p class="help-block" style="color:red;">:message</p>') !!}

      <br>
      <label for="template_name" class="control-label">{{ 'title' }}</label>
      <input class="form-control" name="title" type="text" id="subject" value="{{$pages->title}}">
      {!! $errors->first('title', '<p class="help-block" style="color:red;">:message</p>') !!}

      <br>
      <label for="template_name" class="control-label">{{ 'Content' }}</label>
      <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor">{{$pages->content}}</textarea>
      {!! $errors->first('summary-ckeditors', '<p class="help-block" style="color:red;">:message</p>') !!}

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
</script>
@endsection

