<?php

namespace Modules\Listing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Listing\Services\ListingService;
use Modules\Listing\Models\Listing;
use Modules\Listing\Formatters\ListingFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Listing\Services\ListingResourceService;

class ListingController extends Controller
{
    protected $service;
	protected $moduleName = 'listing';

    public function __construct(ListingService $service)
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
		$listings = $this->service->list();
		//dd($listings->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'listings' => $listings
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
	        $validated = $request->validate( ListingResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $listing = Listing::create($validated);

	        dd('INSERTED:', $listing);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$listing = Listing::findOrFail($id);
		$formatted = ListingFormatter::format($listing);
		//print_r($listing->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $listing
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$listing = Listing::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $listing
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( ListingResourceService::get("{$this->moduleName}/update") );

        // Find and update listing
        $listing = Listing::findOrFail($id);
        $listing->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Listing updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$listing = Listing::findOrFail($id);
        $listing->delete();

        return redirect()
            ->route('listing.index')
            ->with('success', 'Listing deleted successfully.');
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
