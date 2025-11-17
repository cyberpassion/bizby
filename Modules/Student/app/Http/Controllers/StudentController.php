<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Student\Services\StudentService;
use Modules\Student\Models\Student;
use Modules\Student\Formatters\StudentFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Student\Services\StudentResourceService;

class StudentController extends Controller
{
    protected $service;
	protected $moduleName = 'student';

    public function __construct(StudentService $service)
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
		$students = $this->service->list();
		//dd($students->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'students' => $students
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
	        $validated = $request->validate( StudentResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $student = Student::create($validated);

	        dd('INSERTED:', $student);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$student = Student::findOrFail($id);
		$formatted = StudentFormatter::format($student);
		//print_r($student->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $student
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$student = Student::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $student
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( StudentResourceService::get("{$this->moduleName}/update") );

        // Find and update student
        $student = Student::findOrFail($id);
        $student->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Student updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$student = Student::findOrFail($id);
        $student->delete();

        return redirect()
            ->route('student.index')
            ->with('success', 'Student deleted successfully.');
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
