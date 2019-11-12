@extends('Eshopper.master')

@section('title', 'paypal response')
@section('content')

<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			
			<div class="col-sm-1 col-sm-offset-1"></div>
			<div class="col-sm-5 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					@if(Session::get('success'))
					<h2 style="color:">Order has been placed successfully.</h2>
					<?php Session()->forget('success'); ?>

					@endif
					<?php Session()->forget('success'); ?>
					@if(Session::get('error'))
					<h2>{{Session::get('error')}}</h2>
					<?php Session()->forget('error'); ?>
					@endif
					


					
				</div><!--/login form-->
			</div>
			
		</div>
	</div>
</section>

@endsection