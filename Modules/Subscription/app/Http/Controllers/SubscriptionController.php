<?php

namespace Modules\Subscription\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Subscription\Services\SubscriptionService;
use Modules\Subscription\Models\Subscription;
use Modules\Subscription\Formatters\SubscriptionFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Subscription\Services\SubscriptionResourceService;

class SubscriptionController extends Controller
{
    protected $service;
	protected $moduleName = 'subscription';

    public function __construct(SubscriptionService $service)
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
		$subscriptions = $this->service->list();
		//dd($subscriptions->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'subscriptions' => $subscriptions
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
	        $validated = $request->validate( SubscriptionResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $subscription = Subscription::create($validated);

	        dd('INSERTED:', $subscription);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$subscription = Subscription::findOrFail($id);
		$formatted = SubscriptionFormatter::format($subscription);
		//print_r($subscription->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $subscription
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$subscription = Subscription::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $subscription
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( SubscriptionResourceService::get("{$this->moduleName}/update") );

        // Find and update subscription
        $subscription = Subscription::findOrFail($id);
        $subscription->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Subscription updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return redirect()
            ->route('subscription.index')
            ->with('success', 'Subscription deleted successfully.');
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
