<?php

namespace Modules\Consultation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Consultation\Services\ConsultationService;
use Modules\Consultation\Models\Consultation;

class ConsultationController extends Controller
{
    protected $service;

    public function __construct(ConsultationService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$consultations = $this->service->list();
		//dd($consultations->toArray());
        return Inertia::render('consultation/index', [
            'consultations' => $consultations
        ]);
        return view('consultation::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		return Inertia::render('consultation/create');
        return view('consultation::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
		// Validate incoming data
        $validated = $request->validate([
            'consultation_with' => 'required|string|max:255',
            'consultation_date' => 'required|date',
            'patient_name' => 'required|string|max:255',
            'notes'	=> 'nullable|string',
        ]);

        // Create new consultation
        $consultation = Consultation::create($validated);

        // Redirect with success message
        return redirect()
            ->route('consultation.index')
            ->with('success', 'Consultation created successfully.');
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$consultation = Consultation::findOrFail($id);
        return Inertia::render('consultation/show', [
            'consultation' => $consultation
        ]);
        return view('consultation::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$consultation = Consultation::findOrFail($id);
        return Inertia::render('consultation/edit', [
            'consultation' => $consultation
        ]);
        return view('consultation::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate([
            'consultation_with' => 'required|string|max:255',
            'consultation_date' => 'required|date',
            'patient_name' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Find and update consultation
        $consultation = Consultation::findOrFail($id);
        $consultation->update($validated);

        // Redirect with success message
        return redirect()
            ->route('consultation.index')
            ->with('success', 'Consultation updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$consultation = Consultation::findOrFail($id);
        $consultation->delete();

        return redirect()
            ->route('consultation.index')
            ->with('success', 'Consultation deleted successfully.');
	}

	/**
     * Display a home of the resource.
     */
    public function home()
    {
		return Inertia::render('consultation/home');
        return view('consultation::home');
    }

	/**
     * Display a home of the resource.
     */
    public function report()
    {
		return Inertia::render('consultation/report');
        return view('consultation::report');
    }

	/**
     * Display a home of the resource.
     */
    public function settings()
    {
		return Inertia::render('consultation/settings');
        return view('consultation::settings');
    }

}
