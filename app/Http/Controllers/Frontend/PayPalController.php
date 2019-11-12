<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Address;
use Validator;
use URL;
use Session;
use Redirect;

/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\OrderDetails;
use App\CartProducts;
use Cart;
use Auth;

class PayPalController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //parent::__construct();
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithPaypal()
    {

    	return view('Eshopper.paypalresponse');
    }
    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal(Request $request)
    {	
    	
    	$add_id= $request->input('billingaddress');
    	
    	$shipping_add_id= $request->input('shippingaddress');
    	
     $paymentmd = $request->payment;
     $status= $request->input("ShippingToBillAddress");
     if($status== 'on'){
        $shipping_add_id = $add_id;
        
    }
    if($add_id == null){
        $address= new Address;
        $address->customername = $request->input('name');
        $address->address1 = $request->input('address1');
        $address->address2 = $request->input('address2');
        $address->city = $request->input('city');
        $address->mobno = $request->input('mobno');
        $address->zipcode = $request->input('zipcode');
        $address->stateID = $request->input('state');
        $address->countryID = $request->input('country');
        $address->customer_id = Auth::user()->id;
        $address->address_type = "billing";
        $address->save();

        $billing_add_id= $address->id;
        
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
       }
       else{
           $shipping_address_id = $shipping_add_id;

       }

   }
   else{

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
   }
   else{
       $shipping_address_id= $shipping_add_id;

   }
}

$order = new OrderDetails;
$order->cart = cart::content(Auth::user()->id);
$order->shipping_address_id= $shipping_address_id;
$order->billing_address_id= $billing_add_id;
        $order->cart_total= Cart::subTotal();//$request->input('total');
        $order->shipping_charge= $request->input('shippingcharge');
        $order->grand_total= $request->input('total');
        $order->payment_mode= "Paypal";
        $order->status="pending";
        $order->customer_id= Auth::user()->id;
        $order->discount= $request->used_coupon_id;
        $order->save();
        $cart_id= $order->id;
        Session::put('cart_id',$cart_id);
        Session::put('shipping_address_id', $order->shipping_address_id);
        Session::put('billing_address_id', $order->billing_address_id);

        Cart::destroy();

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
        ->setCurrency('INR')
        ->setQuantity(1)
        ->setPrice($request->get('total')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('INR')
        ->setTotal($request->get('total'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
        ->setItemList($item_list)
        ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status')) /** Specify return URL **/
        ->setCancelUrl(URL::route('payment.status'));
        $payment = new Payment();

        $payment->setIntent('Sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirect_urls)
        ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
            
        } 
        catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('addmoney.paywithpaypal');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('addmoney.paywithpaypal');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error','Unknown error occurred');
        return Redirect::route('addmoney.paywithpaypal');
    }
    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('addmoney.paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        //dd($result);exit; 
        if($result->getState() == 'approved') { 
        	$c_id= Session::get('cart_id');
            $s_id= Session::get('shipping_address_id');
            $b_id= Session::get('billing_address_id');

           OrderDetails::where('id', $c_id)->update(
             ['transaction_id' =>$result->id,
             'status' => "processing"]);
            $i=1;$price=0;
            $view = '<table border="1" cellpadding="10px" width="100%">
            <thead>
                <tr>
                    <td>Sr. No </td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>  
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
                    '<td>'.$row->qty*$row->price.'</td></tr>'                           ;
                }

                $view .='</tbody></table>';
                $shipping_address = Address::where('id',$s_id)->get();
                foreach($shipping_address as $shippingaddress){
                    $shipaddress= $shippingaddress->customername.','.$shippingaddress->address1.','.$shippingaddress->address2.','.$shippingaddress->city.','.$shippingaddress->city.','.$shippingaddress->mobno.','.$shippingaddress->zipcode.','.$shippingaddress->stateID.','.$shippingaddress->countryID;
                }

                $billing_address = Address::where('id',$b_id)->get();
                foreach($billing_address as $billingaddress){
                    $billaddress= $billingaddress->customername.','.$billingaddress->address1.','.$billingaddress->address2.','.$billingaddress->city.','.$billingaddress->city.','.$billingaddress->mobno.','.$billingaddress->zipcode.','.$billingaddress->stateID.','.$billingaddress->countryID;
                }
                $cart_order= OrderDetails::find($c_id);
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
                   
               }

               $order_data = array(

                  'shipping_address'  => $shipaddress,
                  
                  'billing_address' => $billaddress,

                  'address' => $billaddress,

                  'payment_method' => "paypal",

                  'template_keys' => "user_order_placed_mail",

                  'order_table' => $view,

                  'order_total' => $price

                  );


               $email = Auth::user()->email;
               $adminemail = "amin@gmail.com";
               Mail::to($email)->send(new SendMail($order_data));
               


               /** it's all right **/
               /** Here Write your database logic like that insert record or value in database if you want **/

               \Session::put('success','Payment success');
               return Redirect::route('addmoney.paywithpaypal');
           }else{
            \Session::put('error','Payment failed');
            return Redirect::route('addmoney.paywithpaypal');}
        }
    }

