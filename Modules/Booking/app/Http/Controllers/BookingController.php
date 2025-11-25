<?php

namespace Modules\Booking\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Booking\Services\BookingService;
use Modules\Booking\Models\Booking;
use Modules\Booking\Formatters\BookingFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Booking\Services\BookingResourceService;

class BookingController extends Controller
{
    protected $service;
	protected $moduleName = 'booking';

    public function __construct(BookingService $service)
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
		$bookings = $this->service->list();
		//dd($bookings->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'bookings' => $bookings
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
	        $validated = $request->validate( BookingResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $booking = Booking::create($validated);

	        dd('INSERTED:', $booking);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$booking = Booking::findOrFail($id);
		$formatted = BookingFormatter::format($booking);
		//print_r($booking->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $booking
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$booking = Booking::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $booking
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( BookingResourceService::get("{$this->moduleName}/update") );

        // Find and update booking
        $booking = Booking::findOrFail($id);
        $booking->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Booking updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()
            ->route('booking.index')
            ->with('success', 'Booking deleted successfully.');
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
