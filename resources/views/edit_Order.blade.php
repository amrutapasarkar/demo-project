@extends('master')
@section('content')
<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <p style="color:gray;font-size:20px;">Edit Order</p>
        <a href="{{ url('/indexorder') }}" title="Back"><button class="btn btn-primary btn-sm" style="margin-left:700px;margin-top:-30px;"><i class="fa fa-arrow-left" aria-hidden="true" ></i> Back</button></a>

        @if ($errors->any())
        <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
        @endif

        @foreach($orders as  $order)
        <form method="POST" action="{{ url('updateorder/'.$order->id.'/'.$order->email.'/update') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}


            <table class="table">
                <h4>Order No:<?php echo  $order->id; ?></h4> 

                <tbody>
                    <tr>
                        <th></th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th></th>

                    </tr>
                    @foreach( $order->cart as $key => $value)
                    <tr>  
                        <td>
                           <?php $img=$value['options'];?>
                           @foreach( $img as $value1)
                           <img src="{{asset('product/'.$value1)}}" style="height:90px;width:100px;"> 
                           @endforeach
                       </td>  
                       <td>
                        <?php echo $value['name']; ?>
                    </td> 
                    <td>
                        <?php echo $value['price']; ?>
                    </td>

                    <td>
                        <?php echo $value['qty']; ?>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
            <p>Order Status: {{ucfirst($order->status)}}</p>
            <p>Order Total: {{$order->grand_total}}</p>
            <p>Customer: {{$order->first_name}} {{$order->last_name}}</p>
            <p>Payment Mode: {{$order->payment_mode}}</p>
        @endforeach                  

        <div class="form-group {{ $errors->has('') ? 'has-error' : ''}}">
            <label for="state" class="control-label">{{ 'Status' }}</label>
            <select id="state" class="form-control" name="status">

                <option value="processing" >Confirmed</option>
                <option value="pending" >Pending</option>
                <option value="processing" >Processing</option>
                <option value="shipped" >Shipped</option>
                <option value="delivered" >Delivered</option>

            </select>

            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" >
        </div>

        </form>

    </div>
</div>
@endsection