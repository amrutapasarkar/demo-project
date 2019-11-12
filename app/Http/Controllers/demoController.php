<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class demoController extends Controller
{
    //Storing product details and image using ajax...
    public function  save(Request $request)
    { 
       
        if($request->ajax())
        {
        	
        	$image = $request->file('Productimage');
        	$new_name = rand().'.'.$image->getClientOriginalExtension();
        	$image->move(public_path('images'),$new_name );
        	$data = DB::table('ajax_product')->insert(['product_name'=> $request->Productname ,'product_price'=>$request->Productprice, 'product_image'=>$new_name]);
    	}
    	echo json_encode($data);
	}
	
}
