@extends('master')
@section('content')
<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <div class="pull-left">
        <h3> Coupons </h3>
        </div>

        <div class="card-body">
        <br>
        <div class="pull-right">
            <a href="{{ url('/admin/coupon') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/admin/coupon/' . $coupon->id . '/edit') }}" title="Edit Coupon"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            <form method="POST" action="{{ url('admin/coupon' . '/' . $coupon->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Coupon" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
        </div>
            <br/>
            <br/>
            <div class="table-responsive" style="width:100%">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $coupon->id }}</td>
                        </tr>
                        <tr><th> Code </th><td> {{ $coupon->code }} </td></tr><tr><th> Type </th><td> {{ $coupon->type }} </td></tr><tr><th> Discount </th><td> {{ $coupon->discount }} </td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
