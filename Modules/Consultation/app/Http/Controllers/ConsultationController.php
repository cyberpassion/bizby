<?php

namespace Modules\Consultation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Consultation\Services\ConsultationService;
use Modules\Consultation\Models\Consultation;
use Modules\Consultation\Formatters\ConsultationFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Consultation\Services\ConsultationResourceService;

class ConsultationController extends Controller
{
    protected $service;
	protected $moduleName = 'consultation';

    public function __construct(ConsultationService $service)
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
		$consultations = $this->service->list();
		//dd($consultations->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'consultations' => $consultations
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
	        $validated = $request->validate( ConsultationResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $consultation = Consultation::create($validated);

	        dd('INSERTED:', $consultation);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$consultation = Consultation::findOrFail($id);
		$formatted = ConsultationFormatter::format($consultation);
		//print_r($consultation->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $consultation
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$consultation = Consultation::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $consultation
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( ConsultationResourceService::get("{$this->moduleName}/update") );

        // Find and update consultation
        $consultation = Consultation::findOrFail($id);
        $consultation->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Consultation updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$consultation = Consultation::findOrFail($id);
        $consultation->delete();

        return redirect()
            ->route('consultation.index')
            ->with('success', 'Consultation deleted successfully.');
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
