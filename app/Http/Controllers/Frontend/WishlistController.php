<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Wishlist;
use DB;
use Cart;
use Auth;
class WishlistController extends Controller
{
    
    /**
     * Store a product into the cart from the wishlist.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\view\view
     */
    public function cartStorebywishlist(Request $request)
    {   
        $q=1;
        $id = $request->id;
        $product= Product::find($id);
        $product_img = DB::table('product_img')->where('product_id', $id)->first();
        foreach(Cart::content() as $row){
            if($row->id == $id){

                $price= $row->price+$product->product_price;
                
                Cart::update($row->rowId,['price'=>$price]);  
            } else {

                goto xyz;
            } 
        }
        xyz:{ $cartitem=Cart::add(['id' => $id, 'name' => $product->product_name, 'qty' => 1, 'price' =>$product->product_price, 'options' => ['img' => $product_img->product_img]]);
    }

    $customer_id = Auth::user()->id;
    Wishlist::where('customer_id',$customer_id)
    ->where('product_id',$id)
    ->delete();

    $wishlist = Wishlist::with('product')->where('customer_id',$customer_id)->get();
    
    return view('Eshopper.showWishlist',compact('wishlist'));
}

}
