<?php

namespace Modules\Service\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Service\Services\ServiceService;
use Modules\Service\Models\Service;
use Modules\Service\Formatters\ServiceFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Service\Services\ServiceResourceService;

class ServiceController extends Controller
{
    protected $service;
	protected $moduleName = 'service';

    public function __construct(ServiceService $service)
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
		$services = $this->service->list();
		//dd($services->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'services' => $services
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
	        $validated = $request->validate( ServiceResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $service = Service::create($validated);

	        dd('INSERTED:', $service);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$service = Service::findOrFail($id);
		$formatted = ServiceFormatter::format($service);
		//print_r($service->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $service
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$service = Service::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $service
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( ServiceResourceService::get("{$this->moduleName}/update") );

        // Find and update service
        $service = Service::findOrFail($id);
        $service->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Service updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$service = Service::findOrFail($id);
        $service->delete();

        return redirect()
            ->route('service.index')
            ->with('success', 'Service deleted successfully.');
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
