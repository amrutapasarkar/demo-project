    @extends('master')

    @section('content')
        <div class="form-group row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                    <h2>Order Management</h2>

                    <div class="pull-right">
                            <form method="GET" action="{{ url('/indexorder') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}" style="margin-left: -42px;">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa fa-search"></i>
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
                                    <th>SR.NO</th>
                                    <th>Order NO</th>
                                    <th>Status</th>
                                    <th>Customer name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($order_details as $item)
                                

                                <tr>
                                   <td>{{ $loop->iteration }}</td>
                                   <td>{{ $item->id }}</td>
                                   <td>{{ $item->status}}</td>

                                   <td>{{ $item->first_name}} {{ $item->last_name}}</td>

                                 
                                    <td>
                                        <a href="{{ url('/showorder/' . $item->id) }}" title="View category"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/editorder/' . $item->id . '/edit') }}" title="Edit category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        <!-- <form method="POST" action="{{ url('/admin/category' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete category" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form> -->
                                    </td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                    <div class="pagination-wrapper"> {!! $order_details->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

            </div>
        </div>            
    @endsection
