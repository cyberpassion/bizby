<?php

namespace Modules\Meetingmanager\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Meetingmanager\Services\MeetingmanagerService;
use Modules\Meetingmanager\Models\Meetingmanager;
use Modules\Meetingmanager\Formatters\MeetingmanagerFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Meetingmanager\Services\MeetingmanagerResourceService;

class MeetingmanagerController extends Controller
{
    protected $service;
	protected $moduleName = 'meetingmanager';

    public function __construct(MeetingmanagerService $service)
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
		$meetingmanagers = $this->service->list();
		//dd($meetingmanagers->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'meetingmanagers' => $meetingmanagers
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
	        $validated = $request->validate( MeetingmanagerResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $meetingmanager = Meetingmanager::create($validated);

	        dd('INSERTED:', $meetingmanager);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$meetingmanager = Meetingmanager::findOrFail($id);
		$formatted = MeetingmanagerFormatter::format($meetingmanager);
		//print_r($meetingmanager->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $meetingmanager
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$meetingmanager = Meetingmanager::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $meetingmanager
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( MeetingmanagerResourceService::get("{$this->moduleName}/update") );

        // Find and update meetingmanager
        $meetingmanager = Meetingmanager::findOrFail($id);
        $meetingmanager->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Meetingmanager updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$meetingmanager = Meetingmanager::findOrFail($id);
        $meetingmanager->delete();

        return redirect()
            ->route('meetingmanager.index')
            ->with('success', 'Meetingmanager deleted successfully.');
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