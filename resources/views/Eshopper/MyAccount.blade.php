@extends('Eshopper.master')
@section('title', 'My account')
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
					@if (session('message'))
					<div class="alert alert-success" role="alert">
						{{ session('message')}}
					</div>
					@endif
					
					<h2 class="title text-center">My Account</h2>
					<div class="status alert alert-success" style="display: none"></div>
					<form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="{{route('updateAccountForm')}}" data-parsley-validate>
						{{ csrf_field() }}
						
						<div class="form-group col-md-12">
							<input type="text" name="first_name" class="form-control" placeholder="First name" value="{{$customer->first_name}}" data-parsley-required="true" data-parsley-required-message = "Please enter your First name" data-parsley-trigger="change focusout">
						</div>
						<div class="form-group col-md-12">
							<input type="text" name="last_name" class="form-control" placeholder="Last name" value="{{$customer->last_name}}" data-parsley-required="true" data-parsley-required-message = "Please enter your Last name" data-parsley-trigger="change focusout">
						</div>
						<div class="form-group col-md-12">
							<input type="email" name="email" class="form-control" placeholder="Email" value="{{$customer->email}}" data-parsley-required="true" data-parsley-required-message = "Please enter your Email" data-parsley-trigger="change focusout">
						</div>
						
						<div class="form-group col-md-12">
							<input type="submit" name="submit" class="btn btn-primary" value="Update" style="margin-bottom: 0px; margin-top: 0px;">
							<?php Session()->forget('message'); ?>
							
						</div>
					</form>
					<div id="hide">
						<button class="btn btn-primary" id="change_password" style="margin-bottom: 10px; margin-top: 0px;">Change Password</button>
					</div>
					<form action="{{ route('changePassword')}}" method="post" data-parsley-validate >
						{{ csrf_field() }}
						<div id="changepasswordform" style="display:none;">
							@if (session('message'))
							<div class="alert alert-success" role="alert">
								{{ session('message')}}
							</div>
							@endif
							<h2 class=	"title text-center">Change Password</h2>
							<div class="form-group col-md-12">
								<input type="password" name="current_password" class="form-control"  placeholder="Current Password" value="" data-parsley-required="true" data-parsley-required-message = "Please enter your Current Password" data-parsley-trigger="change focusout">
							</div>
							<div class="form-group col-md-12">
								<input type="password" name="new_password" class="form-control"  placeholder="New Password" value="" data-parsley-required="true" data-parsley-required-message = "Please enter your New Password" data-parsley-trigger="change focusout">
							</div>
							<div class="form-group col-md-12">
								<input type="password" name="confirm_password" class="form-control"  placeholder="Confirm Password" value="" data-parsley-required="true" data-parsley-required-message = "Please enter confirm password" data-parsley-trigger="change focusout">
							</div>
							<?php Session()->forget('message'); ?>
							<input type="submit" name="submit" class="btn btn-primary" value="Change Password" style="margin-bottom: 0px; margin-top: 0px;">
						</div>
						
					</form>
					
				</div>
			</div>
			<div class="col-sm-3">
				
			</div> 		
		</div>  
	</div>	
</div><!--/#contact-page-->
<script>
	$(document).ready(function(){
		
		$("#change_password").click(function(){
			$("#changepasswordform").show();
			$("#hide").hide();

		});
	});
	

</script>
@endsection
