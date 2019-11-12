<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\category;
use App\ParentCategory;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryRequestUpdate;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 7;

        if (!empty($keyword)) {
            $category = category::where('category', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage);
            $categories = category::with('parent')->get();
        } else {
            $category = category::latest()->paginate($perPage);
            $categories = category::with('parent')->get();
        }
        
        return view('admin.category.index', compact('category','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {    
        $categories = category::all();

        return view('admin.category.create')->with('categories', $categories);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request)
    {

       $data = new Category;
       $data->category = $request->input('category');
       $data->parent_id = $request->input('parent_category');
       $data->save();
       
       return redirect('admin/category')->with('flash_message', 'category added!');
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
        $category = category::findOrFail($id);
        $categories = category::with('parent')->findOrFail($id);
        
        return view('admin.category.show', compact('category','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(category $category)
    { 
        $category = category::findOrFail($category->id);
        $categories = category::all();
        return view('admin.category.edit', compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CategoryRequestUpdate $request, $id)
    {
    
        $requestData = $request->all();
        $category = category::findOrFail($id);
        $category->update($requestData);

        $pcategory =array('parent_id'=>$request->input('parent_category'));
        category::where('id', $id)->update($pcategory);

        return redirect('admin/category')->with('flash_message', 'category updated!');
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
        category::destroy($id);
        $category =array('parent_id'=>'0');
        category::where('parent_id', $id)->update($category);
        return redirect('admin/category')->with('flash_message', 'category deleted!');
    }
}
