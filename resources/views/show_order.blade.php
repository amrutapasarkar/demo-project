@extends('master')
@section('title', 'My Orders')
@section('content')  	    	
<div class="container">
    <div class="form-group row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
	    	<br>
	    	<a href="{{ url('/indexorder') }}" title="Back" style="margin-left: 750px;"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
			<form method="get">
			    {{ csrf_field() }}
				@foreach($orders as  $order)
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
			</form>
	    </div>
	</div>
</div>

@endsection
	