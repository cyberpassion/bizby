<?php

namespace Modules\Cashflow\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Cashflow\Services\CashflowService;
use Modules\Cashflow\Models\Cashflow;
use Modules\Cashflow\Formatters\CashflowFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Cashflow\Services\CashflowResourceService;

class CashflowController extends Controller
{
    protected $service;
	protected $moduleName = 'cashflow';

    public function __construct(CashflowService $service)
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
		$cashflows = $this->service->list();
		//dd($cashflows->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'cashflows' => $cashflows
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
	        $validated = $request->validate( CashflowResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $cashflow = Cashflow::create($validated);

	        dd('INSERTED:', $cashflow);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$cashflow = Cashflow::findOrFail($id);
		$formatted = CashflowFormatter::format($cashflow);
		//print_r($cashflow->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $cashflow
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$cashflow = Cashflow::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $cashflow
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( CashflowResourceService::get("{$this->moduleName}/update") );

        // Find and update cashflow
        $cashflow = Cashflow::findOrFail($id);
        $cashflow->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Cashflow updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$cashflow = Cashflow::findOrFail($id);
        $cashflow->delete();

        return redirect()
            ->route('cashflow.index')
            ->with('success', 'Cashflow deleted successfully.');
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
