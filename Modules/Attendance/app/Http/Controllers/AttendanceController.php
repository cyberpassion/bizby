<?php

namespace Modules\Attendance\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Attendance\Services\AttendanceService;
use Modules\Attendance\Models\Attendance;
use Modules\Attendance\Formatters\AttendanceFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Attendance\Services\AttendanceResourceService;

class AttendanceController extends Controller
{
    protected $service;
	protected $moduleName = 'attendance';

    public function __construct(AttendanceService $service)
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
		$attendances = $this->service->list();
		//dd($attendances->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'attendances' => $attendances
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
	        $validated = $request->validate( AttendanceResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $attendance = Attendance::create($validated);

	        dd('INSERTED:', $attendance);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$attendance = Attendance::findOrFail($id);
		$formatted = AttendanceFormatter::format($attendance);
		//print_r($attendance->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $attendance
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$attendance = Attendance::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $attendance
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( AttendanceResourceService::get("{$this->moduleName}/update") );

        // Find and update attendance
        $attendance = Attendance::findOrFail($id);
        $attendance->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Attendance updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Attendance deleted successfully.');
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
