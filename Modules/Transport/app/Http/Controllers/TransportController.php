<?php

namespace Modules\Transport\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Transport\Services\TransportService;
use Modules\Transport\Models\Transport;
use Modules\Transport\Formatters\TransportFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Transport\Services\TransportResourceService;

class TransportController extends Controller
{
    protected $service;
	protected $moduleName = 'transport';

    public function __construct(TransportService $service)
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
		$transports = $this->service->list();
		//dd($transports->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'transports' => $transports
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
	        $validated = $request->validate( TransportResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $transport = Transport::create($validated);

	        dd('INSERTED:', $transport);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$transport = Transport::findOrFail($id);
		$formatted = TransportFormatter::format($transport);
		//print_r($transport->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $transport
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$transport = Transport::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $transport
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( TransportResourceService::get("{$this->moduleName}/update") );

        // Find and update transport
        $transport = Transport::findOrFail($id);
        $transport->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Transport updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$transport = Transport::findOrFail($id);
        $transport->delete();

        return redirect()
            ->route('transport.index')
            ->with('success', 'Transport deleted successfully.');
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
