<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\UserDetails;
use Auth;

class LoginController extends Controller
{

    /**
     * Display a login form.
     *
     * @return \Illuminate\View\View
     */
    public function show(){
    	
         return view('login');
    }

    /**
     * Display a auth login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
        
    }
    
}
