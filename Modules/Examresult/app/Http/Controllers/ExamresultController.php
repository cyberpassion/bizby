<?php

namespace Modules\Examresult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Examresult\Services\ExamresultService;
use Modules\Examresult\Models\Examresult;
use Modules\Examresult\Formatters\ExamresultFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Examresult\Services\ExamresultResourceService;

class ExamresultController extends Controller
{
    protected $service;
	protected $moduleName = 'examresult';

    public function __construct(ExamresultService $service)
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
		$examresults = $this->service->list();
		//dd($examresults->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'examresults' => $examresults
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
	        $validated = $request->validate( ExamresultResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $examresult = Examresult::create($validated);

	        dd('INSERTED:', $examresult);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$examresult = Examresult::findOrFail($id);
		$formatted = ExamresultFormatter::format($examresult);
		//print_r($examresult->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $examresult
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$examresult = Examresult::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $examresult
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( ExamresultResourceService::get("{$this->moduleName}/update") );

        // Find and update examresult
        $examresult = Examresult::findOrFail($id);
        $examresult->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Examresult updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$examresult = Examresult::findOrFail($id);
        $examresult->delete();

        return redirect()
            ->route('examresult.index')
            ->with('success', 'Examresult deleted successfully.');
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

