<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrackOrderRequest;
use App\OrderDetails;
use App\User;
use Auth;
use Session;

class MyOrdersController extends Controller
{
  
  /**
   * Display a user orders.
   *
   * @return \Illuminate\View\View
   */
  public function showOrders()
  {
    $id= Auth::user()->id;
    $orders = OrderDetails::where('customer_id',$id)->get();

    foreach($orders as $order){

    $order->cart=json_decode($order->cart,true);
    } 
  
    return view('Eshopper.MyOrders',compact('orders'));
  }

  /**
   * Display the track order form and track the order as per email id and  order number
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\View\View
   */
  public function trackOrders(TrackOrderRequest $request)
  {
    $email = $request->input('email');
    $order_id = $request->input('order_id');
    $user = User::where('email',$email)->get();
    foreach($user as $userdata){
      $id= $userdata->id;
    }

    $orders = OrderDetails::where('customer_id',$id)->where('id',$order_id)->get();
    Session::put('i',1);

    return view('Eshopper.track_order',compact('orders'));
  }
}
