<?php

namespace Modules\Eventmanager\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Eventmanager\Services\EventmanagerService;
use Modules\Eventmanager\Models\Eventmanager;
use Modules\Eventmanager\Formatters\EventmanagerFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Eventmanager\Services\EventmanagerResourceService;

class EventmanagerController extends Controller
{
    protected $service;
	protected $moduleName = 'eventmanager';

    public function __construct(EventmanagerService $service)
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
		$eventmanagers = $this->service->list();
		//dd($eventmanagers->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'eventmanagers' => $eventmanagers
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
	        $validated = $request->validate( EventmanagerResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $eventmanager = Eventmanager::create($validated);

	        dd('INSERTED:', $eventmanager);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$eventmanager = Eventmanager::findOrFail($id);
		$formatted = EventmanagerFormatter::format($eventmanager);
		//print_r($eventmanager->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $eventmanager
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$eventmanager = Eventmanager::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $eventmanager
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( EventmanagerResourceService::get("{$this->moduleName}/update") );

        // Find and update eventmanager
        $eventmanager = Eventmanager::findOrFail($id);
        $eventmanager->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Eventmanager updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$eventmanager = Eventmanager::findOrFail($id);
        $eventmanager->delete();

        return redirect()
            ->route('eventmanager.index')
            ->with('success', 'Eventmanager deleted successfully.');
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
