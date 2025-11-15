<?php
namespace Modules\Visitactivity\$CONTROLLER_NAMESPACE$;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class VisitactivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('visitactivity::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('visitactivity::create');
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
        return view('visitactivity::show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('visitactivity::edit', compact('id'));
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
        return view('visitactivity::home');
    }

    public function list()
    {
        return view('visitactivity::list');
    }

    public function report()
    {
        return view('visitactivity::report');
    }

    public function settings()
    {
        return view('visitactivity::settings');
    }

    public function view($id)
    {
        return view('visitactivity::view', compact('id'));
    }
}
