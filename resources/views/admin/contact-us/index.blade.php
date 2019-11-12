@extends('master')

@section('content')
<div class="container">
<div class="form-group row">
<div class="col-sm-2"></div>
<div class="col-sm-10">
    <h2>Contact Us</h2>
</div>
</div>
 <div class="form-group row">
<div class="col-sm-2"></div>
<div class="col-sm-10">
 <div class="pull-right">

     <form method="GET" action="{{ url('/admin/contact-us') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                        <th>#</th><th>Name</th><th>Email</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($contactus as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td><td>{{ $item->email }}</td>
                        <td>
                            <a href="{{ url('/admin/contact-us/' . $item->id) }}" title="View ContactU"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                            <a href="{{ url('/admin/contact-us/' . $item->id . '/edit') }}" title="Edit ContactU"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                            <form method="POST" action="{{ url('/admin/contact-us' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete ContactU" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $contactus->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

        </div>
    </div>
</div>
@endsection
