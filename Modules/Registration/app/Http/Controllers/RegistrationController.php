<?php
namespace Modules\Registration\$CONTROLLER_NAMESPACE$;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('registration::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('registration::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store logic here
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('registration::show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('registration::edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // update logic here
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // delete logic here
    }

    // ----------------------------------------
    // 🔹 Custom Methods for SaaS Modules
    // ----------------------------------------

    public function home()
    {
        return view('registration::home');
    }

    public function list()
    {
        return view('registration::list');
    }

    public function report()
    {
        return view('registration::report');
    }

    public function settings()
    {
        return view('registration::settings');
    }

    public function view($id)
    {
        return view('registration::view', compact('id'));
    }
}
