<?php

namespace Modules\Announcement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Announcement\Services\AnnouncementService;
use Modules\Announcement\Models\Announcement;
use Modules\Announcement\Formatters\AnnouncementFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Announcement\Services\AnnouncementResourceService;

class AnnouncementController extends Controller
{
    protected $service;
	protected $moduleName = 'announcement';

    public function __construct(AnnouncementService $service)
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
		$announcements = $this->service->list();
		//dd($announcements->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'announcements' => $announcements
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
	        $validated = $request->validate( AnnouncementResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $announcement = Announcement::create($validated);

	        dd('INSERTED:', $announcement);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$announcement = Announcement::findOrFail($id);
		$formatted = AnnouncementFormatter::format($announcement);
		//print_r($announcement->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $announcement
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$announcement = Announcement::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $announcement
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( AnnouncementResourceService::get("{$this->moduleName}/update") );

        // Find and update announcement
        $announcement = Announcement::findOrFail($id);
        $announcement->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Announcement updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()
            ->route('announcement.index')
            ->with('success', 'Announcement deleted successfully.');
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
