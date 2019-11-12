<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Configuration;
use Illuminate\Http\Request;
use App\Http\Requests\ConfigurationRequest;
use App\Http\Requests\ConfigurationRequestUpdate;

class ConfigurationsController extends Controller
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
            $configurations = Configuration::where('name', 'LIKE', "%$keyword%")
            ->orWhere('value', 'LIKE', "%$keyword%")
            ->latest()->paginate(7);
        } else {
            $configurations = Configuration::latest()->paginate(7);
        }

        return view('admin.configurations.index', compact('configurations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.configurations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ConfigurationRequest $request)
    {
        $requestData = $request->all();
        
        Configuration::create($requestData);

        return redirect('admin/configurations')->with('flash_message', 'Configuration added!');
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
        $configuration = Configuration::findOrFail($id);

        return view('admin.configurations.show', compact('configuration'));
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
     
        $configuration = Configuration::findOrFail($id);

        return view('admin.configurations.edit', compact('configuration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ConfigurationRequestUpdate $request, $id)
    {
        
        $requestData = $request->all();
        
        $configuration = Configuration::findOrFail($id);
        $configuration->update($requestData);

        return redirect('admin/configurations')->with('flash_message', 'Configuration updated!');
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
        Configuration::destroy($id);

        return redirect('admin/configurations')->with('flash_message', 'Configuration deleted!');
    }
}
