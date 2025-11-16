<?php

namespace Modules\Patient\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Patient\Services\PatientService;
use Modules\Patient\Models\Patient;
use Modules\Patient\Formatters\PatientFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Patient\Services\PatientResourceService;

class PatientController extends Controller
{
    protected $service;
	protected $moduleName = 'patient';

    public function __construct(PatientService $service)
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
		$patients = $this->service->list();
		//dd($patients->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'patients' => $patients
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
	        $validated = $request->validate( PatientResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $patient = Patient::create($validated);

	        dd('INSERTED:', $patient);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$patient = Patient::findOrFail($id);
		$formatted = PatientFormatter::format($patient);
		//print_r($patient->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $patient
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$patient = Patient::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $patient
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( PatientResourceService::get("{$this->moduleName}/update") );

        // Find and update patient
        $patient = Patient::findOrFail($id);
        $patient->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Patient updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()
            ->route('patient.index')
            ->with('success', 'Patient deleted successfully.');
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