<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\ContactUs;
use Illuminate\Http\Request;
use App\Http\Requests\ContactUsRequest;
use Auth;
class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
    
        if (!empty($keyword)) {
            $contactus = ContactUs::where('name', 'LIKE', "%$keyword%")
            ->orWhere('email', 'LIKE', "%$keyword%")
            ->latest()->paginate(7);
        } else {
            $contactus = ContactUs::latest()->paginate(7);
        }

        return view('admin.contact-us.index', compact('contactus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.contact-us.create');
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
        
        $requestData = $request->all();
        
        ContactUs::create($requestData);

        $data= array(

            'name'  => $request->get('name'),
            'contact_no'  => $request->get('contactNo'),
            'email'  => $request->get('email'),
            'comment'  => $request->get('message'),
            'Ip' => $request->getClientIp(),
            'template_keys' => "contact_us_form_submission_mail",

            );
        
        $email = $request->get('email');
        
        Mail::to($email)->send(new SendMail($data));

        return redirect('/contact')->with('flash_message','Thank you for contacting us..! we will get back to you soon...');
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
        $contactus = ContactUs::findOrFail($id);

        return view('admin.contact-us.show', compact('contactus'));
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
        $contactus = ContactUs::findOrFail($id);

        return view('admin.contact-us.edit', compact('contactus'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ContactUsRequest $request, $id)
    {
        
        $requestData = $request->all();
        
        $contactus = ContactUs::findOrFail($id);
        $contactus->update($requestData);


        $data= array(

            'name'  => $request->get('name'),
            'contact_No'  => $request->get('contactNo'),
            'email'  => $request->get('email'),
            'comment'  => $request->get('message'),
            'note'  => $request->get('note'),
            'Ip' => $request->getClientIp(),
            'template_keys' => "admmin_comment_contact_us",

            );
        
        $email = $request->get('email');
        
        Mail::to($email)->send(new SendMail($data));
        return redirect('admin/contact-us')->with('flash_message', 'updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        ContactUs::destroy($id);

        return redirect('admin/contact-us')->with('flash_message', 'Message deleted deleted!');
    }
}
