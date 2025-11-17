<?php

namespace Modules\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Contact\Services\ContactService;
use Modules\Contact\Models\Contact;
use Modules\Contact\Formatters\ContactFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Contact\Services\ContactResourceService;

class ContactController extends Controller
{
    protected $service;
	protected $moduleName = 'contact';

    public function __construct(ContactService $service)
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
		$contacts = $this->service->list();
		//dd($contacts->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'contacts' => $contacts
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
	        $validated = $request->validate( ContactResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $contact = Contact::create($validated);

	        dd('INSERTED:', $contact);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$contact = Contact::findOrFail($id);
		$formatted = ContactFormatter::format($contact);
		//print_r($contact->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $contact
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$contact = Contact::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $contact
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( ContactResourceService::get("{$this->moduleName}/update") );

        // Find and update contact
        $contact = Contact::findOrFail($id);
        $contact->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Contact updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()
            ->route('contact.index')
            ->with('success', 'Contact deleted successfully.');
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