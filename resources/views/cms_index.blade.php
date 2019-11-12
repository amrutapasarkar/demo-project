
@extends('master')

@section('title', 'ShowTemplate page')

@section('content')
	  
<div class="row">      	
    <div class="col-xs-2">
    </div>
    <div class="col-xs-10">
        <h2>Pages</h2>
        <a href="{{ url('CMS') }}" class="btn btn-success" style="width:11%;margin-top:0px;"> Add new </a>
        <div class="pull-right">
            <form method="GET" action="" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
        		<div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}" style="margin-left: -62px;">
                	<span class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                   	<i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>           
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $pages)
                    <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pages-> name}}</td>
                    <td>{{ $pages-> title}}</td>

                    <td>
                    <a href="{{ url('showCMS/'.$pages->id) }}" title="View category"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                    <a href="{{ url('editCMS/'.$pages->id.'/edit') }}" title="Edit category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>	
@endsection

