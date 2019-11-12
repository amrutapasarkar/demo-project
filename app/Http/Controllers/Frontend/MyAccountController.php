<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\User;
use Auth;
use Sesssion;
use Hash;
class MyAccountController extends Controller
{
    
    /**
     * Show the account information form.
     *
     * @return \Illuminate\View\View
     */
    public function showAccountForm()
    {
    	$id= Auth::user()->id;
    	$customer = User::find($id);
        
        return view('Eshopper.MyAccount',compact('customer'));
    }

    /**
     * update the user account information.
     * 
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function updateAccountForm(Request $request)
    {

    	$id= Auth::user()->id;
    	$first_name =$request->input('first_name');
    	$last_name =$request->input('last_name');
    	$email =$request->input('email');	
    	$user=User::where('id', $id)->get();

        $status=User::where('id', $id)
        ->update(['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email]);
        if($status==1){
          Session::put('message','Account information updated successfully');
      }
      
      $customer = User::find($id);
      
      return view('Eshopper.MyAccount',compact('customer'));
    }

    /**
     * validate the current password and update the new password
     * 
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function changePassword(Request $request)
    {

        $id= Auth::user()->id;
        
        $current_password=$request->input('current_password');
        $new_password=$request->input('new_password');
        $confirm_password=$request->input('confirm_password');  
        
        $user=User::find($id);

        if(!Hash::check($current_password, $user->password)){

            Session::put('message','Current password is wrong.');

        }else{
         
            $user->password = Hash::make($confirm_password);
            $user->save();
            Session::put('message','Password changed successfully');
        }
        
        $customer = User::find($id);

        return view('Eshopper.MyAccount',compact('customer'));    
    }

}
