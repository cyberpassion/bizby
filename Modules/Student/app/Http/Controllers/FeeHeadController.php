<?php

namespace App\Http\Controllers\Api;

use App\Models\FeeHead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeeHeadController extends Controller
{
    public function index()
    {
        return FeeHead::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'frequency' => 'nullable',
            'default_amount' => 'numeric',
        ]);

        return FeeHead::create($data);
    }

    public function update(Request $request, $id)
    {
        $head = FeeHead::findOrFail($id);
        $head->update($request->all());

        return $head;
    }

    public function destroy($id)
    {
        FeeHead::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
