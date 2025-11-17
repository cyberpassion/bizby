<?php

namespace Modules\Checklist\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Checklist\Services\ChecklistService;
use Modules\Checklist\Models\Checklist;
use Modules\Checklist\Formatters\ChecklistFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Checklist\Services\ChecklistResourceService;

class ChecklistController extends Controller
{
    protected $service;
	protected $moduleName = 'checklist';

    public function __construct(ChecklistService $service)
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
		$checklists = $this->service->list();
		//dd($checklists->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'checklists' => $checklists
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
	        $validated = $request->validate( ChecklistResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $checklist = Checklist::create($validated);

	        dd('INSERTED:', $checklist);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$checklist = Checklist::findOrFail($id);
		$formatted = ChecklistFormatter::format($checklist);
		//print_r($checklist->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $checklist
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$checklist = Checklist::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $checklist
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( ChecklistResourceService::get("{$this->moduleName}/update") );

        // Find and update checklist
        $checklist = Checklist::findOrFail($id);
        $checklist->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Checklist updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$checklist = Checklist::findOrFail($id);
        $checklist->delete();

        return redirect()
            ->route('checklist.index')
            ->with('success', 'Checklist deleted successfully.');
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