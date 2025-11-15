<?php
namespace Modules\Transport\$CONTROLLER_NAMESPACE$;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transport::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transport::create');
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
        return view('transport::show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('transport::edit', compact('id'));
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
        return view('transport::home');
    }

    public function list()
    {
        return view('transport::list');
    }

    public function report()
    {
        return view('transport::report');
    }

    public function settings()
    {
        return view('transport::settings');
    }

    public function view($id)
    {
        return view('transport::view', compact('id'));
    }
}
