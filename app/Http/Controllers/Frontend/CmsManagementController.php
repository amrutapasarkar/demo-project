<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;
use App\Http\Requests\CmsRequest;
use App\Cms;
use DB;

class CmsManagementController extends Controller
{
  /**
   * @return \Illuminate\View\View
   */
  public function showCMSForm()
  {
    return view('add_static_pages');  
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\View\View
   */
  public function index(Request $request)
  {
    $keyword = $request->get('search');

    if (!empty($keyword)) {
      $pages = Cms::where('name', 'LIKE', "%$keyword%")
      ->orWhere('title', 'LIKE', "%$keyword%")
      ->latest()->paginate($perPage);

    } else {
      
      $pages= Cms::latest()->paginate(7);

    }

    return view('cms_index', compact('pages'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function store(CmsRequest $request)
  {
  	
  	$this->validate($request, [
      'name' => 'required',
      'title' => 'required',
      'summary-ckeditor' => 'required',
      ]);

  	$requestData  = array(

     'name'  => $request->get('name'),
     'title' => $request->get('title'),
     'content' => htmlspecialchars_decode($request->get('summary-ckeditor')),
     );
   
    $cms= Cms::create($requestData);
    return redirect()->route('cms_index')->with('success','Page created successfully');
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
    $pages = Cms::findOrFail($id);

    return view('show_cms', compact('pages'));
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
    $pages = Cms::findOrFail($id);

    return view('edit_cms', compact('pages'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param  int  $id
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function update(CmsRequest $request, $id)
  { 
    $requestData  = array(
      'name'  => $request->get('name'),
      'title' => $request->get('title'),
      'content' => htmlspecialchars_decode($request->get('summary-ckeditor')),
    );

    DB::table('cms')->where('id', $id)->update($requestData);
    $pages= Cms::latest()->paginate(7);   

    return redirect('CMSindex')->with('flash_message', 'Page updated!');
  }  
}
