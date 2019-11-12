<?php

namespace App\Http\Controllers\Frontend;
use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\EmailTemplate;
use DB;

use Session;

class FrontendLoginController extends Controller
{

    /**
     *Validate the frontend user is authorized or not.
     *
     * @return \Illuminate\View\View
     */
    public function login(Request $request)
    {   
        $this->validate($request, [
         
            'email_Address' => 'required',
            'Password' => 'required',
            ]);

        $user_data = array(

         'email'  => $request->get('email_Address'),
         'password' => $request->get('Password'),

         );

        if(Auth::attempt($user_data))
        {
            return redirect('productinfo');
        }
        else
        {
            return back()->with('error', 'Wrong Login Details.');
        }

    }

    /**
     * Allow user to logout.
     */
    public function logout(Request $request) 
    {
        Auth::logout();

        return redirect('/Eshopperlogin');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {   
        $this->validate($request, [

            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
            
            ]);

        $requestData  = array(

            'first_name'  => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email'  => $request->get('email'),
            'password' => bcrypt($request->get('password'))
            );

        $data= array(

            'email'  => $request->get('email'),
            'password' => $request->get('password'),
            'template_keys' => "user_registration_mail",
            );

        $admindata= array(

            'email'  => $request->get('email'),
            'template_keys' => "user_registration_admin_mail",
            );

        $user= User::create($requestData);
        $user->assignRole('customer'); 
        $email = $user->email;
        
        Mail::to($email)->send(new SendMail($data));
        Mail::to('admin@gmail.com')->send(new SendMail($admindata));

        
        return redirect()->route('Eshopperlogin')->with('success','User created successfully');

    }   
}

