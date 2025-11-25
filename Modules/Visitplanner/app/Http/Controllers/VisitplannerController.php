<?php

namespace Modules\Visitplanner\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Visitplanner\Services\VisitplannerService;
use Modules\Visitplanner\Models\Visitplanner;
use Modules\Visitplanner\Formatters\VisitplannerFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Visitplanner\Services\VisitplannerResourceService;

class VisitplannerController extends Controller
{
    protected $service;
	protected $moduleName = 'visitplanner';

    public function __construct(VisitplannerService $service)
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
		$visitplanners = $this->service->list();
		//dd($visitplanners->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'visitplanners' => $visitplanners
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
	        $validated = $request->validate( VisitplannerResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $visitplanner = Visitplanner::create($validated);

	        dd('INSERTED:', $visitplanner);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$visitplanner = Visitplanner::findOrFail($id);
		$formatted = VisitplannerFormatter::format($visitplanner);
		//print_r($visitplanner->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $visitplanner
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$visitplanner = Visitplanner::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $visitplanner
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( VisitplannerResourceService::get("{$this->moduleName}/update") );

        // Find and update visitplanner
        $visitplanner = Visitplanner::findOrFail($id);
        $visitplanner->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Visitplanner updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$visitplanner = Visitplanner::findOrFail($id);
        $visitplanner->delete();

        return redirect()
            ->route('visitplanner.index')
            ->with('success', 'Visitplanner deleted successfully.');
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

