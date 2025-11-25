<?php

namespace Modules\Saleservice\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Saleservice\Services\SaleserviceService;
use Modules\Saleservice\Models\Saleservice;
use Modules\Saleservice\Formatters\SaleserviceFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Saleservice\Services\SaleserviceResourceService;

class SaleserviceController extends Controller
{
    protected $service;
	protected $moduleName = 'saleservice';

    public function __construct(SaleserviceService $service)
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
		$saleservices = $this->service->list();
		//dd($saleservices->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'saleservices' => $saleservices
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
	        $validated = $request->validate( SaleserviceResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $saleservice = Saleservice::create($validated);

	        dd('INSERTED:', $saleservice);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$saleservice = Saleservice::findOrFail($id);
		$formatted = SaleserviceFormatter::format($saleservice);
		//print_r($saleservice->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $saleservice
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$saleservice = Saleservice::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $saleservice
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( SaleserviceResourceService::get("{$this->moduleName}/update") );

        // Find and update saleservice
        $saleservice = Saleservice::findOrFail($id);
        $saleservice->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Saleservice updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$saleservice = Saleservice::findOrFail($id);
        $saleservice->delete();

        return redirect()
            ->route('saleservice.index')
            ->with('success', 'Saleservice deleted successfully.');
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
