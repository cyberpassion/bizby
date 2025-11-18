<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Admin\Services\AdminService;
use Modules\Admin\Models\Admin;
use Modules\Admin\Formatters\AdminFormatter;
use Modules\Admin\Services\AdminResourceService;

class AdminController extends Controller
{
    protected $service;
	protected $moduleName = 'admin';

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

	/**
     * Display a dashboard
     */
    public function index()
    {
        return view("{$this->moduleName}::index");
    }

    /**
     * Display a listing of the resource.
     */
    public function list()
    {
		$admins = $this->service->list();
		//dd($admins->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'admins' => $admins
        ]);
        return view("{$this->moduleName}::list");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		//return Inertia::render("{$this->moduleName}/create");
        return view("{$this->moduleName}::create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
	{
    	try {
	        $validated = $request->validate( AdminResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $admin = Admin::create($validated);

	        dd('INSERTED:', $admin);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$admin = Admin::findOrFail($id);
		$formatted = AdminFormatter::format($admin);
		//print_r($admin->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $admin
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$admin = Admin::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $admin
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( AdminResourceService::get("{$this->moduleName}/update") );

        // Find and update admin
        $admin = Admin::findOrFail($id);
        $admin->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Admin updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()
            ->route('admin.index')
            ->with('success', 'Admin deleted successfully.');
	}

	/**
     * Display a report of the resource.
     */
    public function report()
    {
		return Inertia::render("{$this->moduleName}/report");
        return view("{$this->moduleName}::report");
    }

	/**
     * Display a settings of the resource.
     */
    public function settings()
    {
		return Inertia::render("{$this->moduleName}/settings");
        return view("{$this->moduleName}::settings");
    }

}
