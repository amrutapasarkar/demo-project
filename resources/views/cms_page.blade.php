@extends('Eshopper.master')
@section('title', 'Dashboard')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  @foreach($page as $page)
			  <li class="active">{{$page->title}}</li>
			</ol>
		</div>
  		<?php echo htmlspecialchars_decode($page->content);?>
		@endforeach
	</div>
</section><!--/#do_action-->	
@endsection