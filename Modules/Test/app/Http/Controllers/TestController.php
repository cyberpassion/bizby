<?php

namespace Modules\Test\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Test\Services\TestService;
use Modules\Test\Models\Test;
use Modules\Test\Formatters\TestFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Test\Services\TestResourceService;

class TestController extends Controller
{
    protected $service;
	protected $moduleName = 'test';

    public function __construct(TestService $service)
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
		$tests = $this->service->list();
		//dd($tests->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'tests' => $tests
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
	        $validated = $request->validate( TestResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $test = Test::create($validated);

	        dd('INSERTED:', $test);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$test = Test::findOrFail($id);
		$formatted = TestFormatter::format($test);
		//print_r($test->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $test
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$test = Test::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $test
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( TestResourceService::get("{$this->moduleName}/update") );

        // Find and update test
        $test = Test::findOrFail($id);
        $test->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Test updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$test = Test::findOrFail($id);
        $test->delete();

        return redirect()
            ->route('test.index')
            ->with('success', 'Test deleted successfully.');
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

