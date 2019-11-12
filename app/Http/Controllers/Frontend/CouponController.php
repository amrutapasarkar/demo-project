<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coupon;
use App\UsedCoupons;
use DB;
use Cart;
use Auth;
use Session;

class CouponController extends Controller
{
    /**
	 * Calculate the discount as per the coupon type percent or amount and return the discounted total.
	 *
     * @param \Illuminate\Http\Request $request 
     */
    public function couponDiscount(Request $request)
    {  
        if (Auth::guest()){
            return view('Eshopper.login');
        } else {

            $total=0;
            $this->validate($request, [
                'coupon' => 'required'
                
                ]);
            foreach(Cart::content() as $row){
                $total=$total+$row->qty*$row->price;
            }
            
            $code= $request->input('coupon');
            $coupon = DB::table('coupons')->where('code', $code)->first();
            $customer_id = Auth::user()->id;
            
            if($coupon!= null){

                $coupon_used = UsedCoupons::where('coupon_id',$coupon->id)
                ->where('customer_id',Auth::user()->id)->exists();
                if ($coupon_used == false){   
                    $type = $coupon->type;
                    $discount = $coupon->discount;
                    if($type == 'percent'){
                        
                        $dis = $discount*$total/100;
                        $total = $total-$dis;
                        
                        Session::put('total1',$total);
                        Session::put('coupon_type',$coupon->type);
                        Session::put('discount',$coupon->discount);
                        Session::put('coupon_id',$coupon->id);

                    } else {

                        $discount = $coupon->discount;
                        $total = $total-$discount;
                        Session::put('coupon_type',$coupon->type);
                        Session::put('discount',$coupon->discount);
                        Session::put('coupon_id',$coupon->id);
                        Session::put('total1',$total);
                    }
                    
                    return back();
                } else {

                    return back()->with('error','You have already used the coupon!');
                }
            } else {

                return back()->with('error','Invalid coupon code!');
            }
        }
    }
    
}
