@extends('Eshopper.master')
@section('title', 'My Orders')
@section('content')
<div id="contact-page" class="container">
 <div class="bg">
   
  <div class="row"> 
    <div class="col-sm-4">
     @section('sidebar')
     @include('Eshopper.sidebar')
     @show
   </div>    	
   <div class="col-sm-8">
    <div class="contact-form">
     
     <h2 class="title text-center">My Orders</h2>
     <div class="status alert alert-success" style="display: none"></div>
     <form id="main-contact-form" class="contact-form row" name="contact-form" method="get">
       {{ csrf_field() }}
       @foreach($orders as  $order)
       
       <table class="table">
        <h4>Order No:<?php echo  $order->id; ?></h4> 
        <Strong style="margin-left:540px;">Status:<?php echo  ucfirst($order->status); ?><strong> 
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
             <img src="<?php echo 'product/'.$value1?>" style="height:90px;width:100px;"> 
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
        <tr>
          <td></td> <td></td><td></td>
          <td>
            <?php echo "Shipping charge:".$order->shipping_charge; ?>
          </td>
        </tr> 
        <tr>
          <td></td> <td></td><td></td>
          <td>
            <?php echo "Total:".$order->grand_total; ?>
          </td>
        </tr> 
      </tbody>
    </table>
    @endforeach				           
  </form>
</div>
</div>

</div>  
</div>	
</div><!--/#contact-page-->

@endsection
