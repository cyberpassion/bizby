<?php
namespace Modules\Patient\$CONTROLLER_NAMESPACE$;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('patient::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patient::create');
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
        return view('patient::show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('patient::edit', compact('id'));
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
        return view('patient::home');
    }

    public function list()
    {
        return view('patient::list');
    }

    public function report()
    {
        return view('patient::report');
    }

    public function settings()
    {
        return view('patient::settings');
    }

    public function view($id)
    {
        return view('patient::view', compact('id'));
    }
}
