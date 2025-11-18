<?php

namespace Modules\Communication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Communication\Services\CommunicationService;
use Modules\Communication\Models\Communication;
use Modules\Communication\Formatters\CommunicationFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Communication\Services\CommunicationResourceService;

class CommunicationController extends Controller
{
    protected $service;
	protected $moduleName = 'communication';

    public function __construct(CommunicationService $service)
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
		$communications = $this->service->list();
		//dd($communications->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'communications' => $communications
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
	        $validated = $request->validate( CommunicationResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $communication = Communication::create($validated);

	        dd('INSERTED:', $communication);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$communication = Communication::findOrFail($id);
		$formatted = CommunicationFormatter::format($communication);
		//print_r($communication->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $communication
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$communication = Communication::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $communication
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( CommunicationResourceService::get("{$this->moduleName}/update") );

        // Find and update communication
        $communication = Communication::findOrFail($id);
        $communication->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Communication updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$communication = Communication::findOrFail($id);
        $communication->delete();

        return redirect()
            ->route('communication.index')
            ->with('success', 'Communication deleted successfully.');
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
