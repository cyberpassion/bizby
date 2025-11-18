<?php

namespace Modules\Treatment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Treatment\Services\TreatmentService;
use Modules\Treatment\Models\Treatment;
use Modules\Treatment\Formatters\TreatmentFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Treatment\Services\TreatmentResourceService;

class TreatmentController extends Controller
{
    protected $service;
	protected $moduleName = 'treatment';

    public function __construct(TreatmentService $service)
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
		$treatments = $this->service->list();
		//dd($treatments->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'treatments' => $treatments
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
	        $validated = $request->validate( TreatmentResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $treatment = Treatment::create($validated);

	        dd('INSERTED:', $treatment);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$treatment = Treatment::findOrFail($id);
		$formatted = TreatmentFormatter::format($treatment);
		//print_r($treatment->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $treatment
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$treatment = Treatment::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $treatment
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( TreatmentResourceService::get("{$this->moduleName}/update") );

        // Find and update treatment
        $treatment = Treatment::findOrFail($id);
        $treatment->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Treatment updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$treatment = Treatment::findOrFail($id);
        $treatment->delete();

        return redirect()
            ->route('treatment.index')
            ->with('success', 'Treatment deleted successfully.');
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

