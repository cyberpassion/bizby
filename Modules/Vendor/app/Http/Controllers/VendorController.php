<?php
namespace Modules\Vendor\$CONTROLLER_NAMESPACE$;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vendor::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor::create');
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
        return view('vendor::show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('vendor::edit', compact('id'));
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
        return view('vendor::home');
    }

    public function list()
    {
        return view('vendor::list');
    }

    public function report()
    {
        return view('vendor::report');
    }

    public function settings()
    {
        return view('vendor::settings');
    }

    public function view($id)
    {
        return view('vendor::view', compact('id'));
    }
}
