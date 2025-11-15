<?php
namespace Modules\Note\$CONTROLLER_NAMESPACE$;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('note::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note::create');
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
        return view('note::show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('note::edit', compact('id'));
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
        return view('note::home');
    }

    public function list()
    {
        return view('note::list');
    }

    public function report()
    {
        return view('note::report');
    }

    public function settings()
    {
        return view('note::settings');
    }

    public function view($id)
    {
        return view('note::view', compact('id'));
    }
}
