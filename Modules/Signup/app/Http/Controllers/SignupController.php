<?php

namespace Modules\Signup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Signup\Services\SignupService;
use Modules\Signup\Models\Signup;
use Modules\Signup\Formatters\SignupFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Signup\Services\SignupResourceService;

class SignupController extends Controller
{
    protected $service;
	protected $moduleName = 'signup';

    public function __construct(SignupService $service)
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
		$signups = $this->service->list();
		//dd($signups->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'signups' => $signups
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
	        $validated = $request->validate( SignupResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $signup = Signup::create($validated);

	        dd('INSERTED:', $signup);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$signup = Signup::findOrFail($id);
		$formatted = SignupFormatter::format($signup);
		//print_r($signup->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $signup
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$signup = Signup::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $signup
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( SignupResourceService::get("{$this->moduleName}/update") );

        // Find and update signup
        $signup = Signup::findOrFail($id);
        $signup->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Signup updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$signup = Signup::findOrFail($id);
        $signup->delete();

        return redirect()
            ->route('signup.index')
            ->with('success', 'Signup deleted successfully.');
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

