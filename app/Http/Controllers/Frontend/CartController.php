<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Cart;
use Session;
use App\ProductImage;
use DB;

class CartController extends Controller
{
    /**
     * Add a product into the cart.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function cartStore(Request $request)
    {   
        $id = $request->id;
        $product= Product::find($id);
        $product_img = DB::table('product_img')->where('product_id', $id)->first();
        
        foreach(Cart::content() as $row){
            if($row->id == $id){

                $price= $row->price+$product->product_price;
                Cart::update($row->rowId,['price'=>$price]);
            }
            else{
                goto xyz;
            } 
        }
        xyz:{ 

            $cartitem=Cart::add(['id' => $id, 'name' => $product->product_name, 'qty' => 1, 'price' =>$product->product_price, 'options' => ['img' => $product_img->product_img]]);   
        }

        return redirect('productinfo');

    }


    /**
     * Remove the product from the cart.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeproduct(Request $request)
    {   
        $rowId = $request->rowid;
        Cart::remove($rowId);
        if (Cart::count() == 0){
            session::forget('tot');
            Session::forget('total1');
        }  
        return back();

    }

     /**
	 * Increment the quantity of the product.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
     public function incrementQuantity(Request $request)
     {   
        $price=0;
        $rowId = $request->rowid;
        $rowQty = $request->rowqty+1;      
        $cart = Cart::update($rowId,['qty' => $rowQty]);

        return back();
    }

    /**
     * Decrement the quantity of the product.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function decrementQuantity(Request $request)
    {   
        $rowId = $request->rowid;
        $rowQty = $request->rowqty;
        if($rowQty >1){
            $rowQty = $rowQty-1;
            $cart = Cart::updateCartToMinus($rowId,['qty' => $rowQty ]);
            
        }
        return back();

    }

    /**
     * Calculate the total of the cart.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function total()
    {   
        $total=0;
        foreach(Cart::content() as $row){
            $total=$total+$row->qty*$row->price;
        }
        
        Session::put('total',$total);
        return view('Eshopper.cart');

    }
}
