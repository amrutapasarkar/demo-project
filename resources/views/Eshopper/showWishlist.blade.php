@extends('Eshopper.master')

@section('title', 'wishlist')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Whishlist</div>
                <div class="card-body">

                    <!-- <a href="" title="Back" ><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a> -->
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                               <tr>
                                   <th>Product image</th>
                                   <th>Product name</th>
                                   <th>Price</th>
                                   <th>Quantity</th>


                                   <th>Actions</th>
                               </tr>
                               @foreach($wishlist as $wishlists)
                               <tr>
                                <td><img src="{{asset('product/'.$wishlists->product->product_Image
                                    ->product_img)}}" height="100" width="100">
                                    <td>{{ $wishlists->product->product_name}}</td>
                                    <td>{{ $wishlists->product->product_price}}</td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                           
                                           <input class="cart_quantity_input" type="text" name="quantity" id="quantity" value="1" autocomplete="off" size="2">
                                           
                                       </div>
                                   </td>
                                   <td> 
                                    <a href="{{ url('addcartbywishlist/'.$wishlists->product->id) }}" class="btn btn-primary btn-sm">Add to cart</a>
                                    <form method="POST" action="{{ url('removeproductfromcart/'.$wishlists->product->id) }}" accept-charset="UTF-8" style="display:inline">
                                      {{ csrf_field() }}
                                      <button type="submit" class="btn btn-primary btn-sm" title="Remove" >Remove</button>
                                  </form>
                                  
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>

          </div>
      </div>
  </div>
</div>
</div>

@endsection