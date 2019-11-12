@extends('Eshopper.master')
@section('title', 'Track Order')
<?php $i=0;
$i= Session::get('i'); ?>
@section('content')
<div id="contact-page" class="container">
    	<div class="bg">
	    	    	
    		<div class="row"> 
    		<div class="col-sm-4">
	    				@section('sidebar')
             				@include('Eshopper.sidebar')
        				@show
    			</div>    	
	    		<div class="col-sm-5">
	    			<div class="contact-form">
	    			
	    				
	    				<h2 class="title text-center">Track order</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" id="form" method="post" action="{{route('trackOrders')}}" data-parsley-validate>
				    	{{ csrf_field() }}
				    	
				            <div class="form-group col-md-12">
				                <input type="text" name="email" class="form-control"  placeholder="Email ID" data-parsley-required="true" data-parsley-required-message = "Please enter your Email" data-parsley-trigger="change focusout">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="order_id" class="form-control"  placeholder="Order Id" data-parsley-required="true" data-parsley-required-message = "Please enter the Order Id" data-parsley-trigger="change focusout">
				            </div>
				           
				                  
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary" value="Track Order" id="trackord">
				                

				            </div>
				            <!-- Progress Tracker v2 -->

				            @if($i==1)
				            @foreach($orders as $order)
				            <h4>Order ID: {{$order->id}}</h4>
				             <h4 style="margin-left:300px;margin-top:-30px;">Order Date:{{substr($order->created_at,0,10)}} </h4><br>
				            <div id="progressbar"  >
							<div class="form-group col-md-12">	
							      <ul class="progressbar" >
							        
							        @if($order->status == "pending")
							        <li class="active">Confirmed</li>
							        <li class="active">Pending</li>
							        <li>Processing</li>
							        <li>Shipped</li>
							        <li>Delivered</li>
							        @elseif($order->status == "processing")
							        <li class="active">Confirmed</li>
							         <li class="active">Pending</li>
							        <li class="active">Processing</li>
							        <li>Shipped</li>
							        <li>Delivered</li>
							        @elseif($order->status == "shipped")
							        <li class="active">Confirmed</li>
							         <li class="active">Pending</li>
							        <li class="active">Processing</li>
							        <li class="active">Shipped</li>
							        <li >Delivered</li>
							        @elseif($order->status == "delivered")
							        <li class="active">Confirmed</li>
							         <li class="active">Pending</li>
							        <li class="active">Processing</li>
							        <li class="active">Shipped</li>
							        <li class="active">Delivered</li>
							        @else
							        <li class="active">Confirmed</li>
							        <li>Pending</li>
							        <li>Processing</li>
							        <li>Shipped</li>
							        <li>Delivered</li>
							         @endif
							       
							       
							      </ul>
							 </div>
							 </div>  

							 @endforeach
							 @endif  
							 <?php Session()->forget('i'); ?>


								
				        </form>
	    			</div>
	    		</div>
	    		  	<div class="col-sm-3">
	    				
    			</div> 		
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
   	<script>
	  
   	</script>
@endsection
	