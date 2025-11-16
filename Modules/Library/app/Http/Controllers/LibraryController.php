<?php

namespace Modules\Library\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Library\Services\LibraryService;
use Modules\Library\Models\Library;
use Modules\Library\Formatters\LibraryFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Library\Services\LibraryResourceService;

class LibraryController extends Controller
{
    protected $service;
	protected $moduleName = 'library';

    public function __construct(LibraryService $service)
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
		$librarys = $this->service->list();
		//dd($librarys->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'librarys' => $librarys
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
	        $validated = $request->validate( LibraryResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $library = Library::create($validated);

	        dd('INSERTED:', $library);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$library = Library::findOrFail($id);
		$formatted = LibraryFormatter::format($library);
		//print_r($library->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $library
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$library = Library::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $library
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( LibraryResourceService::get("{$this->moduleName}/update") );

        // Find and update library
        $library = Library::findOrFail($id);
        $library->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Library updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$library = Library::findOrFail($id);
        $library->delete();

        return redirect()
            ->route('library.index')
            ->with('success', 'Library deleted successfully.');
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
