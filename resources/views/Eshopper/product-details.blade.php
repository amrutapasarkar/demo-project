@extends('Eshopper.master')

@section('title', 'Product details')
@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						
						@foreach($category as $cate)
						<div class="panel panel-default">
							
							<div class="panel-heading">
								
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->category}}">
										{{$cate ->category}}
										<span class="badge pull-right"><i class="fa fa-plus"></i></span>
										
									</a>
								</h4>
								
							</div>
							<div id="{{ $cate ->category }}" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										@foreach($categories as $childs)
										@if($cate->id == $childs->parent_id)
										
										<li><a href="{{ url('product/'.$childs->id)}}">{{ $childs->category}}</a>
										</li>
										
										@endif
										@endforeach
									</ul>
								</div>
							</div>
							
						</div>
						@endforeach		
						
						
					</div><!--/category-products-->
					
					<div class="brands_products"><!--brands_products-->
						<h2>Brands</h2>
						<div class="brands-name">
							<ul class="nav nav-pills nav-stacked">
								<li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
								<li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
								<li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
								<li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
								<li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
								<li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
								<li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
							</ul>
						</div>
					</div><!--/brands_products-->
					
					<div class="price-range"><!--price-range-->
						<h2>Price Range</h2>
						<div class="well">
							<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
							<b>$ 0</b> <b class="pull-right">$ 600</b>
						</div>
					</div><!--/price-range-->
					
					<div class="shipping text-center"><!--shipping-->
						<img src="{{asset('dist/img/home/shipping.jpg')}}" alt="" />
					</div><!--/shipping-->
					
				</div>
			</div>
			
			<div class="col-sm-9 padding-right">
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5">
						<div class="view-product">
							@foreach($product as $products)
							<img src="{{asset('product/'.$products->product_img)}}" alt="" />
							<h3>ZOOM</h3>
							@endforeach
						</div>
						<div id="similar-product" class="carousel slide" data-ride="carousel">
							
							<!-- Wrapper for slides -->
							<div class="carousel-inner">
								<div class="item active">
									<a href=""><img src="{{asset('dist/img/product-details/similar1.jpg')}}" alt=""></a>
									<a href=""><img src="{{asset('dist/img/product-details/similar2.jpg')}}" alt=""></a>
									<a href=""><img src="{{asset('dist/img/product-details/similar3.jpg')}}" alt=""></a>
								</div>
								<div class="item">
									<a href=""><img src="{{asset('dist/img/product-details/similar1.jpg')}}" alt=""></a>
									<a href=""><img src="{{asset('dist/img/product-details/similar2.jpg')}}" alt=""></a>
									<a href=""><img src="{{asset('dist/img/product-details/similar3.jpg')}}" alt=""></a>
								</div>
								<div class="item">
									<a href=""><img src="{{asset('dist/img/product-details/similar1.jpg')}}" alt=""></a>
									<a href=""><img src="{{asset('dist/img/product-details/similar2.jpg')}}" alt=""></a>
									<a href=""><img src="{{asset('dist/img/product-details/similar3.jpg')}}" alt=""></a>
								</div>
								
							</div>

							<!-- Controls -->
							<a class="left item-control" href="#similar-product" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right item-control" href="#similar-product" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>

					</div>
					<div class="col-sm-7">
						<div class="product-information"><!--/product-information-->
							@foreach($product as $products)
							<img src="{{asset('dist/img/product-details/new.jpg')}}" class="newarrival" alt="" />
							<h2>{{$products->product_name}}</h2>
							<p></p>
							<img src="{{asset('dist/img/product-details/rating.png')}}" alt="" />
							<span>
								<span></span>
								<label>Quantity:</label>
								<input type="text" value="{{$products->quantity}}" />
								<a href="{{ url('addcart/'.$products->product_id) }}" class="btn btn-fefault cart"><i class="fa fa-shopping-cart" onclick=""></i>Add to cart</a>
							</span>
							<p><b>Availability:</b>
								@if($products->quantity >0)
							</p>In Stock</p>
							@else
							<p>Out of stock</p>
							@endif

							<p><b>Condition:</b> New</p>
							<p><b>Price:</b> {{$products->product_price}} RS.</p>
							<a href=""><img src="{{asset('dist/img/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
							<?php $description = $products->product_description ?>
							@endforeach
						</div><!--/product-information-->
					</div>
				</div><!--/product-details-->
				
				<div class="category-tab shop-details-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li><a href="#details" data-toggle="tab">Details</a></li>

						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade" id="details" >
							
							
							<p>{{$description}}</p>
							
							
						</div>
						
					</div>
				</div><!--/category-tab-->
				
				
			</div>
		</div>
	</div>
</section>
@endsection