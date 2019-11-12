<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use App\Http\Requests\BannerRequestUpdate;


class BannersController extends Controller
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
            $banners = Banner::where('name', 'LIKE', "%$keyword%")
            ->orWhere('banner', 'LIKE', "%$keyword%")
            ->latest()->paginate(7);
        } else {
            $banners = Banner::latest()->paginate(7);
        }
        return view('admin.banners.index', compact('banners'));
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BannerRequest $request)
    {
        
        $requestData = $request->all();
        if ($request->hasFile('banner')) {
            $requestData['banner'] = $request->file('banner')
            ->store('uploads', 'public');
        }

        Banner::create($requestData);
        return redirect('admin/banners')->with('flash_message', 'Banner added!');
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
        $banner = Banner::findOrFail($id);

        return view('admin.banners.show', compact('banner'));
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
        $banner = Banner::findOrFail($id);

        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(BannerRequestUpdate $request, $id)
    {
        
        $requestData = $request->all();
        if ($request->hasFile('banner')) {
            $requestData['banner'] = $request->file('banner')
            ->store('uploads', 'public');
        }

        $banner = Banner::findOrFail($id);
        $banner->update($requestData);

        return redirect('admin/banners')->with('flash_message', 'Banner updated!');
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
        Banner::destroy($id);

        return redirect('admin/banners')->with('flash_message', 'Banner deleted!');
    }
}
