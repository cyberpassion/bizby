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

    public function index(Request $request, int $listingId)
    {
        $blocks = ListingPageBlock::where('listing_id', $listingId)
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,

            'data' => $blocks,
        ]);
    }

    /* =========================================================
     | SHOW
     |========================================================= */

    public function show(int $listingId, int $id)
    {
        $block = ListingPageBlock::where('listing_id', $listingId)
            ->findOrFail($id);

        return response()->json([
            'success' => true,

            'data' => $block,
        ]);
    }

    /* =========================================================
     | STORE
     |========================================================= */

    public function store(Request $request, int $listingId)
    {
        $validated = $request->validate([

            'type' => 'required|string',

            'menu_title' => 'nullable|string|max:255',

            'slug' => 'nullable|string|max:255',

            'title' => 'nullable|string|max:255',

            'subtitle' => 'nullable|string|max:255',

            'content' => 'nullable|string',

            'image' => 'nullable|string',

            'image_2' => 'nullable|string',

            'gallery' => 'nullable|array',

            'video_url' => 'nullable|string',

            'button_text' => 'nullable|string|max:255',

            'button_link' => 'nullable|string|max:500',

            'background_color' => 'nullable|string|max:50',

            'text_color' => 'nullable|string|max:50',

            'layout' => 'nullable|string|max:100',

            'alignment' => 'nullable|string|max:100',

            'extra_data' => 'nullable|array',

            'sort_order' => 'nullable|integer',

            'is_active' => 'nullable|boolean',

            'seo_title' => 'nullable|string|max:255',

            'seo_description' => 'nullable|string',
        ]);

        $validated['listing_id'] = $listingId;

        $block = ListingPageBlock::create($validated);

        return response()->json([
            'status' => 'success',

            'message' => 'Block created successfully.',

            'data' => $block,
        ]);
    }

    /* =========================================================
     | UPDATE
     |========================================================= */

    public function update(Request $request, int $listingId, int $id)
    {
        $block = ListingPageBlock::where('listing_id', $listingId)
            ->findOrFail($id);

        $data = $request->validate([

            'type' => 'nullable|string',

            'menu_title' => 'nullable|string|max:255',

            'slug' => 'nullable|string|max:255',

            'title' => 'nullable|string|max:255',

            'subtitle' => 'nullable|string|max:255',

            'content' => 'nullable|string',

            'image' => 'nullable|string',

            'image_2' => 'nullable|string',

            'gallery' => 'nullable|array',

            'video_url' => 'nullable|string',

            'button_text' => 'nullable|string|max:255',

            'button_link' => 'nullable|string|max:500',

            'background_color' => 'nullable|string|max:50',

            'text_color' => 'nullable|string|max:50',

            'layout' => 'nullable|string|max:100',

            'alignment' => 'nullable|string|max:100',

            'extra_data' => 'nullable|array',

            'sort_order' => 'nullable|integer',

            'is_active' => 'nullable|boolean',

            'seo_title' => 'nullable|string|max:255',

            'seo_description' => 'nullable|string',
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

    public function destroy(int $listingId, int $id)
    {
        $block = ListingPageBlock::where('listing_id', $listingId)
            ->findOrFail($id);

        $block->delete();

        return response()->json([
            'success' => true,

            'message' => 'Block deleted successfully',
        ]);
    }

    /* =========================================================
     | REORDER
     |========================================================= */

    public function reorder(Request $request, int $listingId)
    {
        $request->validate([
            'block_ids' => 'required|array',

            'block_ids.*' => 'required|integer',
        ]);

        foreach ($request->block_ids as $index => $id) {

            ListingPageBlock::where('listing_id', $listingId)
                ->where('id', $id)
                ->update([
                    'sort_order' => $index + 1,
                ]);
        }

        return response()->json([
            'status' => 'success',

            'message' => 'Blocks reordered successfully.',
        ]);
    }
}
