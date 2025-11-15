<?php
namespace Modules\Product\$CONTROLLER_NAMESPACE$;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('product::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product::create');
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
        return view('product::show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('product::edit', compact('id'));
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
        return view('product::home');
    }

    public function list()
    {
        return view('product::list');
    }

    public function report()
    {
        return view('product::report');
    }

    public function settings()
    {
        return view('product::settings');
    }

    public function view($id)
    {
        return view('product::view', compact('id'));
    }
}
