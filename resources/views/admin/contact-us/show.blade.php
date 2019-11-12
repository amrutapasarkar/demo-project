@extends('master')

@section('content')
    <div class="container">
        <div class="form-group row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <h4>Contact Us</h4>
            <a href="{{ url('/admin/contact-us') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/admin/contact-us/' . $contactus->id . '/edit') }}" title="Edit ContactU"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('admin/contactus' . '/' . $contactus->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete ContactU" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $contactus->id }}</td>
                        </tr>
                        <tr><th> Name </th><td> {{ $contactus->name }} </td></tr><tr><th> Email </th><td> {{ $contactus->email }} </td></tr><tr><th> Message</th><td> {{ $contactus->message }} </td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div> 
@endsection
