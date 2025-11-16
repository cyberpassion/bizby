<?php

namespace Modules\Leaveapplication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Leaveapplication\Services\LeaveapplicationService;
use Modules\Leaveapplication\Models\Leaveapplication;
use Modules\Leaveapplication\Formatters\LeaveapplicationFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Leaveapplication\Services\LeaveapplicationResourceService;

class LeaveapplicationController extends Controller
{
    protected $service;
	protected $moduleName = 'leaveapplication';

    public function __construct(LeaveapplicationService $service)
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
		$leaveapplications = $this->service->list();
		//dd($leaveapplications->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'leaveapplications' => $leaveapplications
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
	        $validated = $request->validate( LeaveapplicationResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $leaveapplication = Leaveapplication::create($validated);

	        dd('INSERTED:', $leaveapplication);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$leaveapplication = Leaveapplication::findOrFail($id);
		$formatted = LeaveapplicationFormatter::format($leaveapplication);
		//print_r($leaveapplication->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $leaveapplication
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$leaveapplication = Leaveapplication::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $leaveapplication
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( LeaveapplicationResourceService::get("{$this->moduleName}/update") );

        // Find and update leaveapplication
        $leaveapplication = Leaveapplication::findOrFail($id);
        $leaveapplication->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Leaveapplication updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$leaveapplication = Leaveapplication::findOrFail($id);
        $leaveapplication->delete();

        return redirect()
            ->route('leaveapplication.index')
            ->with('success', 'Leaveapplication deleted successfully.');
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
