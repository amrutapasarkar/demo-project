<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EmailTemplate;
use App\Http\Requests\TemplateRequest;
use DB;

class EmailTemplateController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\View\View
   */
  public function index(Request $request)
  {
    $keyword = $request->get('search');
    $perPage = 07;

    if (!empty($keyword)){

      $emailtemplate = EmailTemplate::where('email_template_name','LIKE',"%$keyword%")->orWhere('status', 'LIKE', "%$keyword%")->latest()->paginate($perPage);

    } else {
      
      $emailtemplate = EmailTemplate::get();
    }

    return view('template_index', compact('emailtemplate'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function store(TemplateRequest $request)
  {
    $requestData  = array(
      
      'email_template_name'  => $request->get('template_name'),
      'email_template_content' => htmlspecialchars_decode($request->get('summary-ckeditor')),
      'email_subject' => $request->get('email_subject'),
      'template_keys' => $request->get('template_key'),
      'status' => "active"
      );
    
    $email_template= EmailTemplate::create($requestData);

    return redirect()->route('indextemplate')->with('success','Template created successfully');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\View\View
   */
  public function edit(Request $request)
  {	  
    $id=$request->id;
    $edittemplate = EmailTemplate::find($id);
    
    return view('edit_template', compact('edittemplate'));

  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @param  int  $id
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public  function updatetemplate(TemplateRequest $request, $id)
  {
    
    $id = $request->id;
    $email_template_name = $request->get('template_name');
    $email_template_content = $request->get('summary-ckeditor');
    $email_subject= $request->get('email_subject');
    $email_template= DB::table('email_template')
    ->where('id', $id)
    ->update(['email_template_name' => $email_template_name,'email_template_content' =>$email_template_content, 'email_subject' => $email_subject]);

    return redirect()->route('indextemplate')->with('success','Template updated successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   *
   * @return \Illuminate\View\View
   */
  public function show(Request $request)
  {
    
    $id=$request->id;
    $showtemplate = EmailTemplate::find($id);
    
    return view('show_template', compact('showtemplate'));
  }

}
