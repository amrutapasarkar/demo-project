<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderDetails;
use App\users;
use App\Address;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use DB;

class OrderManagementController extends Controller
{
    /**
     * Display a listing of the placed orders.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 8;

        if (!empty($keyword)) {
         $order_details = DB::table('users')
         ->join('order_details','users.id','=','order_details.customer_id')
         ->where('order_details.status', 'LIKE', "%$keyword%")
         ->orWhere('order_details.id', 'LIKE', "%$keyword%")
         ->orWhere('users.first_name', 'LIKE', "%$keyword%")
         ->orWhere('users.last_name', 'LIKE', "%$keyword%")
         ->groupBy()->orderby('order_details.id', 'DESC')->paginate($perPage);
     } else {
        
        $order_details = DB::table('users')
        ->join('order_details','users.id','=','order_details.customer_id')
        ->groupBy()->orderby('order_details.id', 'DESC')->paginate($perPage);  
    }

    return view('index_order', compact('order_details'));
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $orders = DB::table('users')
        ->join('order_details','users.id','=','order_details.customer_id')
        ->where('order_details.id',$id)
        ->get();

        foreach($orders as $order){

          $order->cart=json_decode($order->cart,true);

      } 

      return view('show_order', compact('orders'));
  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $orders = DB::table('users')
        ->join('order_details','users.id','=','order_details.customer_id')
        ->where('order_details.id',$id)
        ->get();
        foreach($orders as $order){

          $order->cart=json_decode($order->cart,true);

      } 
      
      return view('edit_Order', compact('orders'));
  }

    /**
     * Update the status of the order..
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @param  String  $email
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id,$email)
    {
    	$perPage=10;
        $status = $request->input('status');
        
        
        DB::table('order_details')->where('id', $id)->update(['status'=>$status]);

        $orders = OrderDetails::where('id',$id)->get();

        foreach($orders as $order){

          $order->cart=json_decode($order->cart,true);

      } $i=1;
      
      $view = '<table border="1" cellpadding="10px" width="100%">
      <thead>
        <tr>
           <th>Sr.No</th>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
       </tr>
   </thead>
   <tbody>';
       
    foreach($order->cart as $key => $value){
     
        $view .=
        '<tr>'.
        '<td>'.$i++.'</td>'.
        '<td>'.$value['name'].'</td>'.
        '<td>'.$value['price'].'</td>'.
        '<td>'.$value['qty'].'</td>'.
        '<td>'.$order->subtotal.'</td>'.
        '</tr>'
        ;
    }

    $view .='</tbody></table>';

    $shipping_address = Address::find($order->shipping_address_id);

    $billing_address = Address::find($order->billing_address_id);

    $order_data = array(
        'tracking_code' => mt_rand(123456,999999),

        'shipping_address'  =>$shipping_address->customername.','.$shipping_address->address1.','.$shipping_address->address2.','.$shipping_address->city.','.$shipping_address->zipcode.','.$shipping_address->mobno,
        
        'billing_address' =>$billing_address->customername.','.$billing_address->address1.','.$billing_address->address2.','.$billing_address->city.','.$billing_address->zipcode.','.$billing_address->mobno,

        'address' =>$billing_address->customername.','.$billing_address->address1.','.$billing_address->address2.','.$billing_address->city.','.$billing_address->zipcode.','.$billing_address->mobno,

        'payment_method' => $order->payment_mode,

        'template_keys' => "order_status_change_mail",

        'order_table' => $view,

        'order_total' => $order->grand_total,

        );
    Mail::to($email)->send(new SendMail($order_data));
    
    return redirect('indexorder')->with('flash_message', 'Order updated!');
}
}
