<?php
namespace Modules\Meetingmanager\$CONTROLLER_NAMESPACE$;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MeetingmanagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('meetingmanager::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('meetingmanager::create');
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
        return view('meetingmanager::show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('meetingmanager::edit', compact('id'));
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
        return view('meetingmanager::home');
    }

    public function list()
    {
        return view('meetingmanager::list');
    }

    public function report()
    {
        return view('meetingmanager::report');
    }

    public function settings()
    {
        return view('meetingmanager::settings');
    }

    public function view($id)
    {
        return view('meetingmanager::view', compact('id'));
    }
}
