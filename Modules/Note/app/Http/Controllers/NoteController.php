<?php

namespace Modules\Note\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Note\Services\NoteService;
use Modules\Note\Models\Note;
use Modules\Note\Formatters\NoteFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Note\Services\NoteResourceService;

class NoteController extends Controller
{
    protected $service;
	protected $moduleName = 'note';

    public function __construct(NoteService $service)
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
		$notes = $this->service->list();
		//dd($notes->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'notes' => $notes
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
	        $validated = $request->validate( NoteResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $note = Note::create($validated);

	        dd('INSERTED:', $note);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$note = Note::findOrFail($id);
		$formatted = NoteFormatter::format($note);
		//print_r($note->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $note
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$note = Note::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $note
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( NoteResourceService::get("{$this->moduleName}/update") );

        // Find and update note
        $note = Note::findOrFail($id);
        $note->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Note updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$note = Note::findOrFail($id);
        $note->delete();

        return redirect()
            ->route('note.index')
            ->with('success', 'Note deleted successfully.');
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
