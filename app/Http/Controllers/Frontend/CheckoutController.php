<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Address;
use App\OrderDetails;
use App\CartProducts;
use Auth;
use Cart;
use Redirect;
use App\Wishlist;
use App\Product;
use App\ProductAttributeAssoc;
use App\UsedCoupons;
use DB;


class CheckoutController extends Controller
{
    /**
     * Display the address of the user.
     *
     * @return \Illuminate\View\View
     */
    public function address()
    {

      if (Auth::guest()){

        return view('Eshopper.login');

      } else {

        $id= Auth::user()->id;
        $addresses = DB::table('addresses')
        ->leftJoin('country', 'country.id', '=', 'addresses.countryID')
        ->leftJoin('states', 'states.id', '=', 'addresses.stateID')
        ->select('addresses.*','country.country_name','states.state_name')
        ->where('customer_id',$id)
        ->get();
        
        $state = DB::table('states')->get();
        $country = DB::table('country')->get();

        return view('Eshopper.check',compact('addresses','state','country'));
      }

    }

    /**
     * Place the order of the specified user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function checkout(Request $request)
    {   
      $add_id= $request->input('billingaddress');
      $shipping_add_id= $request->input('shippingaddress');
      $paymentmd = $request->payment;
      $status= $request->input("ShippingToBillAddress");

      if($status == 'on'){
        $shipping_add_id = $add_id; 
      }
      if($paymentmd =="COD"){
        
        if($add_id == null){

          $address = new Address;
          $address->customername=$request->input('name');
          $address->address1=$request->input('address1');
          $address->address2=$request->input('address2');
          $address->city=$request->input('city');
          $address->mobno=$request->input('mobno');
          $address->zipcode=$request->input('zipcode');
          $address->stateID=$request->input('state');
          $address->countryID=$request->input('country');
          $address->customer_id=Auth::user()->id;
          $address->address_type= "billing";
          $address->save();

          $billing_add_id = $address->id;

          if($shipping_add_id == null){

            $address = new Address;
            $address->customername=$request->input('sname');
            $address->address1=$request->input('saddress1');
            $address->address2=$request->input('saddress2');
            $address->city=$request->input('scity');
            $address->mobno=$request->input('smobno');
            $address->zipcode=$request->input('szipcode');
            $address->stateID=$request->input('sstate');
            $address->countryID=$request->input('scountry');
            $address->customer_id=Auth::user()->id;
            $address->address_type= "shipping";
            $address->save();
            $shipping_address_id = $address->id;

          } else{

            $shipping_address_id= $shipping_add_id;
          }

        } else {

          $billing_add_id=$add_id;
          if($shipping_add_id == null){

            $saddress = new Address;
            $saddress->customername=$request->input('sname');
            $saddress->address1=$request->input('saddress1');
            $saddress->address2=$request->input('saddress2');
            $saddress->city=$request->input('scity');
            $saddress->mobno=$request->input('smobno');
            $saddress->zipcode=$request->input('szipcode');
            $saddress->stateID=$request->input('sstate');
            $saddress->countryID=$request->input('scountry');
            $saddress->customer_id=Auth::user()->id;
            $saddress->address_type= "shipping";
            $saddress->save();
            $shipping_address_id= $address->id;

          } else {
    
            $shipping_address_id= $shipping_add_id;
          }
        }

        $string = str_random(15);
        $order = new OrderDetails;
        $order->cart = cart::content(Auth::user()->id);
        $order->shipping_address_id= $shipping_address_id;
        $order->billing_address_id= $billing_add_id;
        $order->cart_total= Cart::subTotal();//$request->input('total');
        $order->shipping_charge= $request->input('shippingcharge');
        $order->grand_total= $request->input('total');
        $order->payment_mode= "COD";
        $order->status= "pending";
        $order->transaction_id= "PAYID-".$string;
        $order->discount= $request->used_coupon_id;
        $order->customer_id= Auth::user()->id;
        $order->save();
        Cart::destroy();


        $cart_order= OrderDetails::find($order->id);
        $cart_order->cart = json_decode($cart_order->cart,true);
        foreach( $cart_order->cart as $key => $value ){

        	$cart_product = new CartProducts;
          $cart_product->product_id = $value['id'];
          $cart_product->product_name = $value['name'];
          $cart_product->product_qty = $value['qty'];
          $cart_product->product_price = $value['price'];
          $cart_product->date = substr($cart_order->created_at,0,10);
          $cart_product->order_id = $cart_order->id;
          $cart_product->save();
          $product_qty = ProductAttributeAssoc::where('product_id',$value['id']);
          $product_qty->decrement('quantity', $value['qty']);
        }
        if($order->discount != NULL){

          $coupon = new UsedCoupons;
          $coupon->coupon_id= $order->discount;
          $coupon->customer_id= Auth()->user()->id;
          $coupon->save();
        }

        $shipping_address = Address::where('id',$order->shipping_address_id)->get();
        foreach($shipping_address as $shippingaddress){
        	$shipaddress= $shippingaddress->customername.','.$shippingaddress->address1.','.$shippingaddress->address2.','.$shippingaddress->city.','.$shippingaddress->city.','.$shippingaddress->mobno.','.$shippingaddress->zipcode.','.$shippingaddress->stateID.','.$shippingaddress->countryID;
        }

        $billing_address = Address::where('id',$order->billing_address_id)->get();
        foreach($billing_address as $billingaddress){
        	$billaddress= $billingaddress->customername.','.$billingaddress->address1.','.$billingaddress->address2.','.$billingaddress->city.','.$billingaddress->city.','.$billingaddress->mobno.','.$billingaddress->zipcode.','.$billingaddress->stateID.','.$billingaddress->countryID;
        }
        $i=1;$price=0;
        
        $view = '<table border="1" cellpadding="10px" width="100%">
        <thead>
          <tr>
            <th>Sr.No</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>';
          
          foreach(Cart::content() as $row){
            $price=$price+$row->qty*$row->price;
            $view .=
            '<tr><td>'.$i++.'</td>'.
            '<td>'.$row->name.'</td>'.
            '<td>'.$row->price.'</td>'.
            '<td>'.$row->qty.'</td>'.
            '<td>'.$row->qty*$row->price.'</td></tr>'
            ;
          }

          $view .='</tbody></table>';

          $order_data = array(

           'shipping_address'  => $shipaddress,
           'billing_address' => $billaddress,
           'address' => $billaddress,
           'payment_method' => $paymentmd,
           'template_keys' => "user_order_placed_mail",
           'order_table' => $view,
           'order_total' => $price
           );

          $email = Auth::user()->email;
          Mail::to($email)->send(new SendMail($order_data));

          return view('Eshopper.success');

        }

      } 

    /**
     * Add the specified product to user wishlist
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function wishlist(Request $request){
    	$customer_id = Auth::user()->id;
    	$prod_id=$request->id;
    	$wishlist= new Wishlist;
    	$wishlist->customer_id= Auth::user()->id;
    	$wishlist->product_id= $prod_id;
    	$wishlist->save();
      
    	$wishlist= Wishlist::with('product')->where('customer_id',$customer_id)->get();

    	return view('Eshopper.showWishlist',compact('wishlist'));

    }
    
     /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
     public function showWishlist(Request $request){
       $customer_id = Auth::user()->id;
       $wishlist= wishlist::with('product')->where('customer_id',$customer_id)->get();
       
       return view('Eshopper.showWishlist',compact('wishlist'));
     }

    /**
     * Remove the specified product from the wishlist.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function removeProductFromCart(Request $request){
    	$customer_id = Auth::user()->id;
    	$product_id= $request->id;
    	$wishlist= Wishlist::where('customer_id',$customer_id)
      ->where('product_id',$product_id)
      ->delete();

      $wishlist= Wishlist::with('product')->where('customer_id',$customer_id)->get();
      
      return view('Eshopper.showWishlist',compact('wishlist'));
    }
  }
