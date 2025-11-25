<?php

namespace Modules\Visitactivity\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Visitactivity\Services\VisitactivityService;
use Modules\Visitactivity\Models\Visitactivity;
use Modules\Visitactivity\Formatters\VisitactivityFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Visitactivity\Services\VisitactivityResourceService;

class VisitactivityController extends Controller
{
    protected $service;
	protected $moduleName = 'visitactivity';

    public function __construct(VisitactivityService $service)
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
		$visitactivitys = $this->service->list();
		//dd($visitactivitys->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'visitactivitys' => $visitactivitys
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
	        $validated = $request->validate( VisitactivityResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $visitactivity = Visitactivity::create($validated);

	        dd('INSERTED:', $visitactivity);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$visitactivity = Visitactivity::findOrFail($id);
		$formatted = VisitactivityFormatter::format($visitactivity);
		//print_r($visitactivity->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $visitactivity
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$visitactivity = Visitactivity::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $visitactivity
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( VisitactivityResourceService::get("{$this->moduleName}/update") );

        // Find and update visitactivity
        $visitactivity = Visitactivity::findOrFail($id);
        $visitactivity->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Visitactivity updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$visitactivity = Visitactivity::findOrFail($id);
        $visitactivity->delete();

        return redirect()
            ->route('visitactivity.index')
            ->with('success', 'Visitactivity deleted successfully.');
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

