<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Newsletter;
class NewsletterController extends Controller
{

     /**
     * Allow user for subscription.ss
     *
     * @param \Illuminate\Http\Request $request
     *
     */
     public function store(Request $request)
     {
        if ( ! Newsletter::isSubscribed($request->email) ) 
        {
            Newsletter::subscribePending($request->email);
            return redirect('Eshopperlogin')->with('success', 'Thanks For Subscribe');
        }
        return redirect('Eshopperlogin')->with('failure', 'Sorry! You have already subscribed ');
        
    }
}