<?php
namespace Modules\Saleservice\$CONTROLLER_NAMESPACE$;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SaleserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('saleservice::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('saleservice::create');
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
        return view('saleservice::show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('saleservice::edit', compact('id'));
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
        return view('saleservice::home');
    }

    public function list()
    {
        return view('saleservice::list');
    }

    public function report()
    {
        return view('saleservice::report');
    }

    public function settings()
    {
        return view('saleservice::settings');
    }

    public function view($id)
    {
        return view('saleservice::view', compact('id'));
    }
}
