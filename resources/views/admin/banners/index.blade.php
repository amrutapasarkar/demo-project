@extends('master')

@section('content')

<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <br>   
        <h2>Banners</h2>
    </div>
</div>   
 
   
<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
         @if ($message = Session::get('flash_message'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="pull-left">
            <a href="{{ url('/admin/banners/create') }}" class="btn btn-success btn-sm" title="Add New Banner">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>
        </div>

        <div class="pull-right">

           <form method="GET" action="{{ url('/admin/banners') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}" style="margin-left: -42px;">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>  
    </div>         
    <br/>
    <br/>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Banner</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td><td><img src="{{asset('storage/'.$item->banner)}}" height="50" width="50"></td>
                    <td>
                        <a href="{{ url('/admin/banners/' . $item->id) }}" title="View Banner"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                        <a href="{{ url('/admin/banners/' . $item->id . '/edit') }}" title="Edit Banner"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('/admin/banners' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Banner" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $banners->appends(['search' => Request::get('search')])->render() !!} </div>
    </div>

    
    
</div>
</div>


@endsection
