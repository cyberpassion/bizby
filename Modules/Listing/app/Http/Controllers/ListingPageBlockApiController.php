<?php

namespace Modules\Listing\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Listing\Models\ListingPageBlock;

class ListingPageBlockApiController extends Controller
{
    /* =========================================================
     | INDEX
     |========================================================= */

    public function index(Request $request)
    {
        $query = ListingPageBlock::query();

        if ($request->filled('listing_id')) {
            $query->where('listing_id', $request->listing_id);
        }

        return response()->json([
            'success' => true,
            'data' => $query
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    /* =========================================================
     | SHOW
     |========================================================= */

    public function show($id)
    {
        return response()->json([
            'success' => true,
            'data' => ListingPageBlock::findOrFail($id),
        ]);
    }

    /* =========================================================
     | STORE
     |========================================================= */

    public function store(Request $request)
    {
        $data = $request->validate([

            'listing_id' => 'required|exists:central.listings,id',

            'type' => 'required|string',

            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',

            'content' => 'nullable|string',

            'image' => 'nullable|string',
            'image_2' => 'nullable|string',

            'gallery' => 'nullable|array',

            'video_url' => 'nullable|string',

            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',

            'extra_data' => 'nullable|array',

            'sort_order' => 'nullable|integer',

            'is_active' => 'nullable|boolean',

            'background_color' => 'nullable|string',
            'text_color' => 'nullable|string',
        ]);

        $block = ListingPageBlock::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Block created successfully',
            'data' => $block,
        ]);
    }

    /* =========================================================
     | UPDATE
     |========================================================= */

    public function update(Request $request, $id)
    {
        $block = ListingPageBlock::findOrFail($id);

        $data = $request->validate([

            'type' => 'nullable|string',

            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',

            'content' => 'nullable|string',

            'image' => 'nullable|string',
            'image_2' => 'nullable|string',

            'gallery' => 'nullable|array',

            'video_url' => 'nullable|string',

            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',

            'extra_data' => 'nullable|array',

            'sort_order' => 'nullable|integer',

            'is_active' => 'nullable|boolean',

            'background_color' => 'nullable|string',
            'text_color' => 'nullable|string',
        ]);

        $block->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Block updated successfully',
            'data' => $block,
        ]);
    }

    /* =========================================================
     | DELETE
     |========================================================= */

    public function destroy($id)
    {
        $block = ListingPageBlock::findOrFail($id);

        $block->delete();

        return response()->json([
            'success' => true,
            'message' => 'Block deleted successfully',
        ]);
    }
}