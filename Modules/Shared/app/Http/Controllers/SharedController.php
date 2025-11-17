<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Shared\Services\SharedService;
use Modules\Shared\Models\Shared;
use Modules\Shared\Formatters\SharedFormatter;
use Modules\Shared\Services\SharedResourceService;

use Illuminate\Support\Facades\Storage;

class SharedController extends Controller
{

	protected $service;
	protected $moduleName = 'shared';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shared::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shared::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('shared::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('shared::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}

}
