<?php

namespace Modules\Vendor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Vendor\Services\VendorService;
use Modules\Vendor\Models\Vendor;
use Modules\Vendor\Formatters\VendorFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Vendor\Services\VendorResourceService;

class VendorController extends Controller
{
    protected $service;
	protected $moduleName = 'vendor';

    public function __construct(VendorService $service)
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
		$vendors = $this->service->list();
		//dd($vendors->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'vendors' => $vendors
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
	        $validated = $request->validate( VendorResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $vendor = Vendor::create($validated);

	        dd('INSERTED:', $vendor);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$vendor = Vendor::findOrFail($id);
		$formatted = VendorFormatter::format($vendor);
		//print_r($vendor->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $vendor
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$vendor = Vendor::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $vendor
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( VendorResourceService::get("{$this->moduleName}/update") );

        // Find and update vendor
        $vendor = Vendor::findOrFail($id);
        $vendor->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Vendor updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect()
            ->route('vendor.index')
            ->with('success', 'Vendor deleted successfully.');
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
