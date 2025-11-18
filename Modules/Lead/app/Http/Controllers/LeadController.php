<?php

namespace Modules\Lead\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Lead\Services\LeadService;
use Modules\Lead\Models\Lead;
use Modules\Lead\Formatters\LeadFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Lead\Services\LeadResourceService;

class LeadController extends Controller
{
    protected $service;
	protected $moduleName = 'lead';

    public function __construct(LeadService $service)
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
		$leads = $this->service->list();
		//dd($leads->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'leads' => $leads
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
	        $validated = $request->validate( LeadResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $lead = Lead::create($validated);

	        dd('INSERTED:', $lead);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$lead = Lead::findOrFail($id);
		$formatted = LeadFormatter::format($lead);
		//print_r($lead->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $lead
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$lead = Lead::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $lead
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( LeadResourceService::get("{$this->moduleName}/update") );

        // Find and update lead
        $lead = Lead::findOrFail($id);
        $lead->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Lead updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$lead = Lead::findOrFail($id);
        $lead->delete();

        return redirect()
            ->route('lead.index')
            ->with('success', 'Lead deleted successfully.');
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