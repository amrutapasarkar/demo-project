
@extends('master')

@section('title', 'ShowTemplate page')

@section('content')
	  
<div class="row">
	      	
    <div class="col-xs-2"></div>
    <div class="col-xs-10">
    <h2>Templates</h2>	     
    <a href="{{ route('addtemplate') }}" class="btn btn-success" style="width:11%;margin-top:0px;">Add template</a>
    <div class="pull-right">
        <form method="GET" action="{{ url('/indextemplate') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
    		<div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}" style="margin-left: -62px;">
            	<span class="input-group-append">
                <button class="btn btn-secondary" type="submit">
               	<i class="fa fa-search"></i></button>
                </span>

                </div>
        </form>
    </div>
    <br>               
    <div class="table-responsive" style="width:100%;">
        <table class="table">
            <thead>
                <tr>
                <th>#</th>
                <th>Templates</th>
                <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($emailtemplate as $emailtemplates)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $emailtemplates-> email_template_name}}</td>
                <td>
                <a href="{{ url('showTemplate/'.$emailtemplates->id) }}" title="View category"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                <a href="{{ url('editTemplate/'.$emailtemplates->id) }}" title="Edit category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                <form method="POST" action="{{ url('/admin/category') }}" accept-charset="UTF-8" style="display:inline">
                    
                </form>
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>	
@endsection

