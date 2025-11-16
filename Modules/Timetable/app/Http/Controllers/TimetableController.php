<?php

namespace Modules\Timetable\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Timetable\Services\TimetableService;
use Modules\Timetable\Models\Timetable;
use Modules\Timetable\Formatters\TimetableFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Timetable\Services\TimetableResourceService;

class TimetableController extends Controller
{
    protected $service;
	protected $moduleName = 'timetable';

    public function __construct(TimetableService $service)
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
		$timetables = $this->service->list();
		//dd($timetables->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'timetables' => $timetables
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
	        $validated = $request->validate( TimetableResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $timetable = Timetable::create($validated);

	        dd('INSERTED:', $timetable);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$timetable = Timetable::findOrFail($id);
		$formatted = TimetableFormatter::format($timetable);
		//print_r($timetable->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $timetable
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$timetable = Timetable::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $timetable
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( TimetableResourceService::get("{$this->moduleName}/update") );

        // Find and update timetable
        $timetable = Timetable::findOrFail($id);
        $timetable->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Timetable updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$timetable = Timetable::findOrFail($id);
        $timetable->delete();

        return redirect()
            ->route('timetable.index')
            ->with('success', 'Timetable deleted successfully.');
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

