<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order_details;
use App\cart_products;
use App\User;
use DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the sales report.
     *
     * @return \Illuminate\View\View
     */
    public function showSalesReports()
    {
      $perPage=5; 
           
      $order =  DB::table('cart_products')
            ->select(DB::raw('sum(product_qty) as product_qty'),'product_name','product_price')
            ->groupBy('product_id')->paginate($perPage);
            
      return view('sales_report',compact('order'));
        
    }

    /**
     * Display a listing of the customer report.
     *
     * @return \Illuminate\View\View
     */
    public function showCustomerReports()
    {    
      $perPage=5; 
      $customers = DB::table('users')
            ->join('model_has_roles','model_has_roles.model_id','=','users.id')
            ->where('role_id',5)
            ->groupBy('users.id')->paginate($perPage);
            
      return view('customer_report',compact('customers'));
        
    }

    /**
     * Display a listing of the coupons report.
     *
     * @return \Illuminate\View\View
     */

    public function showCouponsReports()
    {    
      $perPage = 5;
      $coupons = DB::table('used_coupon')
            ->join('coupons','used_coupon.coupon_id','=','coupons.id')
            ->join('users','used_coupon.customer_id','=','users.id')
            ->groupBy('coupons.id')->paginate($perPage);
      
      return view('coupons_report',compact('coupons'));
        
    }

    /**
     * Display a listing of the sales report according to date range.
     *
     * @return \Illuminate\View\View
     */
    public function dateRangeRecords(Request $request)
    { 
    	$perPage=5;
    
    	if($request->from_date != '' && $request->to_date != '')
    	{
       	$order = DB::table('cart_products')->
       	select(DB::raw('sum(product_qty) as product_qty'),'product_name','product_price')
         ->whereBetween('date', array($request->from_date, $request->to_date))
         ->groupBy('product_id')->paginate($perPage);
       
		  } else {
     	  $order  =  DB::table('cart_products')
          ->select(DB::raw('sum(product_qty) as product_qty'),'product_name','product_price')
          ->groupBy('product_id')->paginate($perPage);
      }
     	return view('sales_report',compact('order'));
     
    }

    /**
     * Display a listing of the customer report according to date range.
     *
     * @return \Illuminate\View\View
     */
    public function dateRangeRecordsofCustomer(Request $request)
    {
    	$perPage=5;
	    if(($request->from_date != '' && $request->to_date != '') || ($request->name !='')){
		
		  $customers= DB::table('users')
		       	->join('model_has_roles','model_has_roles.model_id','=','users.id')
		       	->where('role_id',5);

		  if($request->from_date != '' && $request->to_date != '')
		  {
        $start_time= $request->from_date.' 00:00:00';
        $end_time=  $request->to_date.' 23:59:59';
		    $customers->whereBetween('created_at', array($start_time, $end_time ));
      }
		  if($request->name != ''){

		 			$customers->where('first_name', 'LIKE',"%$request->name%")->
                    orWhere('email', 'LIKE',"%$request->name%");
		 	}
			$customers = $customers->groupBy('users.id')->paginate($perPage);
	 		} else {

		       $customers = DB::table('users')
		       	->join('model_has_roles','model_has_roles.model_id','=','users.id')
		       	->where('role_id',5)
		       	->groupBy('users.id')->paginate($perPage);
	    }	   

     	return view('customer_report',compact('customers'));

    }

    /**
     * Display a listing of the coupons report according to date range.
     *
     * @return \Illuminate\View\View
     */
    public function  dateRangeRecordsofCoupons (Request $request)
    { 
       
        $perPage=5;
        if(($request->from_date != '' && $request->to_date != '') || ($request->name !=''))
        {
                
          $coupons = DB::table('used_coupon')
            ->join('coupons','used_coupon.coupon_id','=','coupons.id')
            ->join('users','used_coupon.customer_id','=','users.id');
        
          if($request->from_date != '' && $request->to_date != '')
          {

            $start_time= $request->from_date.' 00:00:00';
            $end_time=  $request->to_date.' 23:59:59';
            $coupons->whereBetween('used_coupon.created_at', array($start_time, $end_time ));

          }
          if($request->name != ''){

            $coupons->where('first_name', 'LIKE', "%$request->name%")
                ->orWhere('title', 'LIKE', "%$request->name%")
                ->orWhere('type', 'LIKE', "%$request->name%");

          }
          $coupons = $coupons ->groupBy('coupons.id')->paginate($perPage);
                
          } else {

            $coupons = DB::table('used_coupon')
                ->join('coupons','used_coupon.coupon_id','=','coupons.id')
                ->join('users','used_coupon.customer_id','=','users.id')
                ->groupBy('coupons.id')->paginate($perPage);
          }
          return view('coupons_report',compact('coupons')); 
    
    }   
}
