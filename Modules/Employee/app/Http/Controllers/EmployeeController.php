<?php

namespace Modules\Employee\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Employee\Services\EmployeeService;
use Modules\Employee\Models\Employee;
use Modules\Employee\Formatters\EmployeeFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Employee\Services\EmployeeResourceService;

class EmployeeController extends Controller
{
    protected $service;
	protected $moduleName = 'employee';

    public function __construct(EmployeeService $service)
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
		$employees = $this->service->list();
		//dd($employees->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'employees' => $employees
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
	        $validated = $request->validate( EmployeeResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $employee = Employee::create($validated);

	        dd('INSERTED:', $employee);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$employee = Employee::findOrFail($id);
		$formatted = EmployeeFormatter::format($employee);
		//print_r($employee->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $employee
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$employee = Employee::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $employee
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( EmployeeResourceService::get("{$this->moduleName}/update") );

        // Find and update employee
        $employee = Employee::findOrFail($id);
        $employee->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Employee updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()
            ->route('employee.index')
            ->with('success', 'Employee deleted successfully.');
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

