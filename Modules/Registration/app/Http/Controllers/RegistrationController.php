<?php

namespace Modules\Registration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Registration\Services\RegistrationService;
use Modules\Registration\Models\Registration;
use Modules\Registration\Formatters\RegistrationFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Registration\Services\RegistrationResourceService;

class RegistrationController extends Controller
{
    protected $service;
	protected $moduleName = 'registration';

    public function __construct(RegistrationService $service)
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
		$registrations = $this->service->list();
		//dd($registrations->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'registrations' => $registrations
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
	        $validated = $request->validate( RegistrationResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $registration = Registration::create($validated);

	        dd('INSERTED:', $registration);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$registration = Registration::findOrFail($id);
		$formatted = RegistrationFormatter::format($registration);
		//print_r($registration->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $registration
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$registration = Registration::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $registration
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( RegistrationResourceService::get("{$this->moduleName}/update") );

        // Find and update registration
        $registration = Registration::findOrFail($id);
        $registration->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Registration updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$registration = Registration::findOrFail($id);
        $registration->delete();

        return redirect()
            ->route('registration.index')
            ->with('success', 'Registration deleted successfully.');
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
