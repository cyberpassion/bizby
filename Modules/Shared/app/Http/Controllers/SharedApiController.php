<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Shared\Services\SharedService;
use Modules\Shared\Models\Shared;

class SharedApiController extends Controller
{
    protected $service;

    public function __construct(SharedService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$shareds = $this->service->list();
		return response()->json(['data' => $shareds]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		return Inertia::render('shared/create');
        return view('shared::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
		// Validate incoming data
        $validated = $request->validate([
            'shared_with' => 'required|string|max:255',
            'shared_date' => 'required|date',
            'patient_name' => 'required|string|max:255',
            'notes'	=> 'nullable|string',
        ]);

        // Create new shared
        $shared = Shared::create($validated);

        // Redirect with success message
        return redirect()
            ->route('shared.index')
            ->with('success', 'Shared created successfully.');
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$shared = Shared::findOrFail($id);
        return Inertia::render('shared/show', [
            'shared' => $shared
        ]);
        return view('shared::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$shared = Shared::findOrFail($id);
        return Inertia::render('shared/edit', [
            'shared' => $shared
        ]);
        return view('shared::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate([
            'shared_with' => 'required|string|max:255',
            'shared_date' => 'required|date',
            'patient_name' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Find and update shared
        $shared = Shared::findOrFail($id);
        $shared->update($validated);

        // Redirect with success message
        return redirect()
            ->route('shared.index')
            ->with('success', 'Shared updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$shared = Shared::findOrFail($id);
        $shared->delete();

        return redirect()
            ->route('shared.index')
            ->with('success', 'Shared deleted successfully.');
	}

	/**
     * Display a home of the resource.
     */
    public function home()
    {
		return Inertia::render('shared/home');
        return view('shared::home');
    }

}
