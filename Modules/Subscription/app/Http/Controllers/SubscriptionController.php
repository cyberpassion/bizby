<?php
namespace Modules\Subscription\$CONTROLLER_NAMESPACE$;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('subscription::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subscription::create');
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
        return view('subscription::show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('subscription::edit', compact('id'));
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
        return view('subscription::home');
    }

    public function list()
    {
        return view('subscription::list');
    }

    public function report()
    {
        return view('subscription::report');
    }

    public function settings()
    {
        return view('subscription::settings');
    }

    public function view($id)
    {
        return view('subscription::view', compact('id'));
    }
}
