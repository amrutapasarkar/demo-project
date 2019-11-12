@extends('Eshopper.master')

@section('title', 'Dashboard')
@section('content')
<?php
$cartSubTotal=Session::get('subtotal');
$total= Session::get('grandtotal');
$coupon_id= Session::get('coupon_id');
$coupon_type = session::get('coupon_type');
$discount = session::get('discount');
$cartTotal=0;
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<form id="mainform" name="sub"  method="POST" action="{{route('checkout')}}" data-parsley-validate>
	{{ csrf_field() }}
	<div class="bs-example">
		
		<div class="accordion" id="accordionExample">
			<div class="card">
				<div class="card-header" id="headingOne">
					<h2 class="mb-0">
						<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" style="width:100%;text-align:left;">
							<div class="register-req" >
								Select Billing address
							</div>
						</button>									
					</h2>
				</div>
				<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">

						<select style="width:50%;height:30px;margin-left:50px;" id="address" name="billingaddress">
							<option value=''>Select billing address</option>
							@foreach($addresses as $address)		
							<option  value="{{$address->id}}">

								{{$address->customername}}<span>,</span>
								{{$address->address1}}<span>,</span>
								{{$address->address2}}<span>,</span>
								{{$address->city}}<span>,</span>
								{{$address->zipcode}}<span>,</span>
								{{$address->mobno}}<span>,</span>
								{{$address->state_name}}<span>,</span>
								{{$address->country_name}}
								
							</option>
							@endforeach
						</select>
						
					</div>
					<div class="form-one" style="margin-top: 10px;margin-left:50px;">
						
						<h4>Billing Address</h4>
						<input type="text" placeholder="Name" name="name" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px; width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your name" data-parsley-trigger="change focusout"><br>
						<input type="text" placeholder="Address 1" name="address1" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width:540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your address1" data-parsley-trigger="change focusout"><br>
						<input type="text" placeholder="Address 2" name="address2" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your address2" data-parsley-trigger="change focusout"><br>
						<input type="text" placeholder="City" name="city" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your city" data-parsley-trigger="change focusout"><br>
						<input type="text" placeholder="Zip Code" name="zipcode" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your zip code" data-parsley-trigger="change focusout"><br>
						<input type="text" placeholder="Mobile no" name="mobno" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your Mobile no" data-parsley-trigger="change focusout"><br>
						<div class="selected" style="display:none;">
							<input type="text" placeholder="State" name="textstate" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter state name" data-parsley-trigger="change focusout"><br>
							<input type="text" placeholder="Country" name="textcountry" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter country name" data-parsley-trigger="change focusout">

						</div>
						
						<div class="optionnotselected">
							<select id="country" style="margin-bottom:10px;height:35px;" name="country">
								<option>Select Country</option>
								@foreach($country as $countries)
								<option value="{{$countries->id}}">{{$countries->country_name}}</option>
								@endforeach
							</select>
							

							<select id="state" style="margin-bottom:10px;height:35px;" name="state">
								<option value=" "> </option>
							</select>
						</div>

						<br>
						<label><input type="checkbox" id="ShippingToBillAddress" name="ShippingToBillAddress"> Shipping to bill address</label><br>
						
						<br>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingtwo">
					<h2 class="mb-0">
						<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapsetwo" style="width:100%;text-align:left;">
							<div class="register-req" >
								Select Shipping address
							</div>
						</button>									
					</h2>
				</div>
				<div id="collapsetwo" class="collapse" aria-labelledby="headingtwo" data-parent="#accordionExample">
					<div class="card-body">
						<select style="width:50%;height:30px;margin-left:50px;" id="shippingaddress" name="shippingaddress">
							<option value=''>Select shipping address</option>
							@foreach($addresses as $address)		
							<option  value="{{$address->id}}">

								{{$address->customername}}<span>,</span>
								{{$address->address1}}<span>,</span>
								{{$address->address2}}<span>,</span>
								{{$address->city}}<span>,</span>
								{{$address->zipcode}}<span>,</span>
								{{$address->mobno}}<span>,</span>
								{{$address->state_name}}<span>,</span>
								{{$address->country_name}}
								
							</option>
							@endforeach
						</select>
						
					</div>
					<div class="form-one" style="margin-top: 10px;margin-left:50px;">
						
						<h4>Shipping Address</h4>
						<input type="text" placeholder="Name" name="sname" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px; width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your name" data-parsley-trigger="change focusout"><br>
						<input type="text" placeholder="Address 1" name="saddress1" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width:540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter address 1" data-parsley-trigger="change focusout"><br>
						<input type="text" placeholder="Address 2" name="saddress2" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your address2" data-parsley-trigger="change focusout"><br>
						<input type="text" placeholder="City" name="scity" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your city" data-parsley-trigger="change focusout"><br>
						<input type="text" placeholder="Zip Code" name="szipcode" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your zip code" data-parsley-trigger="change focusout"><br>
						<input type="text" placeholder="Mobile no" name="smobno" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your mobile no" data-parsley-trigger="change focusout"><br>
						<div class="shippingoptionselected" style="display:none;">
						<input type="text" placeholder="State" name="textsstate" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your state" data-parsley-trigger="change focusout"><br>
						<input type="text" placeholder="Country" name="textscountry" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;" data-parsley-required="true" data-parsley-required-message = "Please enter your country" data-parsley-trigger="change focusout">
						</div>
						<div class="shippingoptionnotselected">
							<select id="scountry" style="margin-bottom:10px;height:35px;" name="scountry">
								<option>Select Country</option>
								@foreach($country as $countries)
								<option value="{{$countries->id}}">{{$countries->country_name}}</option>
								@endforeach
							</select>
							

							<select id="sstate" style="margin-bottom:10px;height:35px;" name="sstate">
								<option value=" "></option>
							</select>
						</div>
						
					</div>

				</div>
				
			</div>
			<div class="card">
				<div class="card-header" id="headingtwo">
					<h2 class="mb-0">
						<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapsethree" style="width:100%;text-align:left;">
							<div class="register-req" >
								Shipping Charges
							</div>
						</button>									
					</h2>
				</div>
				<div id="collapsethree" class="collapse" aria-labelledby="headingtwo" data-parent="#accordionExample">
					<div class="card-body">
						@if($cartSubTotal >= 500)
						<p style="margin-left:50px;">Free shipping</p>
						<input type="checkbox" name="" value="" style="margin-left:50px;" checked disabled> Free
						@elseif($cartSubTotal <= 500)
						<p style="margin-left:50px;">As the the order size is less than 500 so you need to pay the shipping charge of 50RS.</p>
						<input type="checkbox" name="" value="" style="margin-left:50px;" checked disabled>50RS.
						@endif 
					</div>
					<div class="form-one" style="margin-top: 10px;margin-left:50px;">
					</div>

				</div>
				
			</div>	
			<div class="card">
				<div class="card-header" id="headingtwo">
					<h2 class="mb-0">
						<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapsefive" style="width:100%;text-align:left;">
							<div class="register-req" >
								Order Preview
							</div>
						</button>									
					</h2>
				</div>
				<div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordionExample">
					<div class="card-body">               
						<div class="table-responsive cart_info">
							<table class="table table-condensed">
								<thead>
									<tr class="cart_menu" style="margin-left:50px;">
										<td class="image" ></td>
										<td class="description"></td>
										<td class="price">Price</td>
										<td class="quantity">Quantity</td>
										<td class="total">Total</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									
									@foreach(Cart::content() as $row)
									
									<tr>
										<td class="cart_product">
											<a href=""><img src="{{asset('product/'.$row->options->img)}}" alt="" height="110px" width="100px"/></a>
										</td>
										<td class="cart_description">
											<h4><a href="">Colorblock Scuba</a></h4>
											<p>{{ $row->name }}</p>
										</td>
										<td class="cart_price">
											<p>{{$row->price}}</p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button">
												<a class="cart_quantity_up" href="{{url('incrementQuantity/'.$row->rowId.'/'.$row->qty)}}" > + </a>
												<input class="cart_quantity_input" type="text" name="quantity" id="quantity" value="{{$row->qty}}" autocomplete="off" size="2">
												<a class="cart_quantity_down" href="{{url('decrementQuantity/'.$row->rowId.'/'.$row->qty)}}"> - </a>
											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">{{$row->price*$row->qty}}</p>
											<span hidden>{{$cartTotal=$cartTotal+$row->price*$row->qty}}</span>
										</td>
										<td class="cart_delete">
											<a class="cart_quantity_delete" href="{{asset('removeproduct/'.$row->rowId)}}"><i class="fa fa-times"></i></a>
										</td>
									</tr>	
									@endforeach
									
								</tbody>
							</table>
							<div class="col-sm-6"></div>
							<div class="col-sm-6">
								
								<div class="total_area">
									<ul>

										
										<label>Cart sub total</label>
										<input type="text"  name="subtotal" value="{{$cartSubTotal}} " style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;">
										{{Session::put('subtotal',$cartSubTotal)}}
										@if($cartTotal>500)
										<label>Shipping Cost</label>
										<input type="text"  name="shippingcharge" value="0" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;">
										
										@else
										<label>Shipping Cost</label>
										<input type="text"  name="shippingcharge" value="50" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;">
										@endif
										<label>Coupons used</label>
										<input type="text"  name="shippingcharge" value="{{$discount}}{{$coupon_type}}" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;">
										<?php
										Session()->forget('coupon_type');
										Session()->forget('discount');?>
										@if($cartTotal>500)
										<label>Total</label>
										<input type="text" placeholder="total" name="total" value="{{$total}}" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;">
										
										@else
										<label>Total</label>
										<input type="text" placeholder="total" name="total" value="{{$total+50}}" style="background-color: #F0F0E9;border: none;height: 40px;padding-left: 10px;width: 540;margin-bottom:10px;">
										
										@endif
										<input type="hidden" value="{{session::get('coupon_id')}}" name="used_coupon_id"> <?php Session()->forget('coupon_id');?>						</ul>

										
										
									</div>
								</form>
							</div>
						</div>
					</div>
					
				</div>
				<div class="card">
					<div class="card-header" id="headingtwo">
						<h2 class="mb-0">
							<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapsefour" style="width:100%;text-align:left;">
								<div class="register-req" >
									Payment Method
								</div>
							</button>									
						</h2>
					</div>
					<div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordionExample">
						<div class="card-body">               
							<input type="radio" name="payment" value="COD" id="payment" style="margin-left:50px;" checked onchange="$('#CODbutton').show();$('#paypalbutton').hide();">Cash on Delivery
							<input type="radio" name="payment" value="paypal" id="payment" style="margin-left:50px;" onchange="$('#CODbutton').hide();$('#paypalbutton').show();">Paypal<br>
							
							<div id="CODbutton">
								<input type="submit" class="btn btn-primary btn-sm" style="margin-left:50px;margin-bottom:10px;" name="sub" value="Place order" id="button"><br>
							</div>
							
							<div id="paypalbutton" style="display:none">
								<button class="btn btn-primary btn-sm"  formaction="{{route('addmoney.paypal')}}" id="formButton" name="submit" style="margin-left:50px;margin-bottom:10px;" formmethod="POST">Place Order  with paypal</button><br>
							</div>
						</div>
						<br>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('select[name="billingaddress"]').on('change', function() {
			var billingaddress = $(this).val();

			if(billingaddress) {
				$.ajax({
					url: '/address-dropdown/'+billingaddress,
					type: "GET",
					dataType: "json",
					success:function(data) {
						$.each(data, function(key, value) {	
							$('.optionnotselected').hide();
							$('.selected').show();
							$('input[name="name"]').val(value.customername).attr("disabled", true);
							$('input[name="address1"]').val(value.address1).attr("disabled", true);
							$('input[name="address2"]').val(value.address2).attr("disabled", true);
							$('input[name="city"]').val(value.city).attr("disabled", true);
							$('input[name="zipcode"]').val(value.zipcode).attr("disabled", true);
							$('input[name="mobno"]').val(value.mobno).attr("disabled", true);
							$('input[name="textstate"]').val(value.state_name).attr("disabled", true);
							$('input[name="textcountry"]').val(value.country_name).attr("disabled", true);   
						});
					}
				});
			} else{
				$('input[name="name"]').val('');
				$('input[name="address1"]').val('');
				$('input[name="address2"]').val('');
				$('input[name="city"]').val('');
				$('input[name="zipcode"]').val('');
				$('input[name="mobno"]').val('');
				$('.selected').show();
				$('.optionnotselected').hide();
			}           
		});
		$('select[name="shippingaddress"]').on('change', function() {
			
			var shippingaddress = $(this).val();
			
			if(shippingaddress) {
				$.ajax({
					url: '/address-dropdown/'+shippingaddress,
					type: "GET",
					dataType: "json",
					success:function(data) {
						$.each(data, function(key, value) {	
							$('.shippingoptionnotselected').hide();
							$('.shippingoptionselected').show();
							$('input[name="sname"]').val(value.customername).attr("disabled", true);
							$('input[name="saddress1"]').val(value.address1).attr("disabled", true);
							$('input[name="saddress2"]').val(value.address2).attr("disabled", true);
							$('input[name="scity"]').val(value.city).attr("disabled", true);
							$('input[name="szipcode"]').val(value.zipcode).attr("disabled", true);
							$('input[name="smobno"]').val(value.mobno).attr("disabled", true);
							$('input[name="textsstate"]').val(value.state_name).attr("disabled", true);
							$('input[name="textscountry"]').val(value.country_name).attr("disabled", true);
						});
					}
				});
			} else {
				$('input[name="sname"]').val('');
				$('input[name="saddress1"]').val('');
				$('input[name="saddress2"]').val('');
				$('input[name="scity"]').val('');
				$('input[name="szipcode"]').val('');
				$('input[name="smobno"]').val('');
				$('.shippingoptionnotselected').show();
				$('.shippingoptionselected').hide();
				
			}           
		});
		
		$('select[name="country"]').on('change', function() {
			var country = $(this).val();
			if(country) {
				$.ajax({
					url: '/country-dropdown/'+country,
					type: "GET",
					dataType: "json",
					success:function(data) {
						
						$('select[name="state"]').empty();
						$.each(data, function(key, value) {
							$('select[name="state"]').append('<option value="'+ value.id +'">'+ value.state_name +'</option>');
						});
					}
				});
			}else{
				$('select[name="state"]').empty();
			}
		});
		
		$('select[name="scountry"]').on('change', function() {
			var scountry = $(this).val();
			if(scountry) {
				$.ajax({
					url: '/country-dropdown/'+scountry,
					type: "GET",
					dataType: "json",
					success:function(data) {
						
						$('select[name="sstate"]').empty();
						$.each(data, function(key, value) {
							$('select[name="sstate"]').append('<option value="'+ value.id +'">'+ value.state_name +'</option>');
						});
					}
				});
			}else{
				$('select[name="sstate"]').empty();
			}
		});

		$('#ShippingToBillAddress').click(function() {
			
			if ($(this).is(':checked')) {
				var billingaddress = $('#address').val();
				$.ajax({
					url: '/address-dropdown/'+billingaddress,
					type: "GET",
					dataType: "json",
					success:function(data) {
						
						
						$.each(data, function(key, value) {
							$('.shippingoptionnotselected').hide();
							$('.shippingoptionselected').show();
							$('input[name="sname"]').val(value.customername).attr("disabled", true);
							$('input[name="saddress1"]').val(value.address1).attr("disabled", true);
							$('input[name="saddress2"]').val(value.address2).attr("disabled", true);
							$('input[name="scity"]').val(value.city).attr("disabled", true);
							$('input[name="szipcode"]').val(value.zipcode).attr("disabled", true);
							$('input[name="smobno"]').val(value.mobno).attr("disabled", true);
							$('input[name="textsstate"]').val(value.state_name).attr("disabled", true);
							$('input[name="textscountry"]').val(value.country_name).attr("disabled", true);
						});
					}
				});
				
			}
			else{


			}
		});

	});

</script>

@endsection