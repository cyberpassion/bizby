<?php

namespace Modules\Listing\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Listing\Services\ListingTrackingService;
use App\Http\Controllers\Controller;

class ListingTrackingApiController extends Controller
{
    public function track(Request $request, $id)
    {
        $type = $request->get('type', 'view');

        ListingTrackingService::track($id, $type);

        return response()->json([
            'status' => 'success',
            'message' => 'Event tracked',
        ], Response::HTTP_OK);
    }

    public function contactClick($id)
    {
        ListingTrackingService::track($id, 'contact_click');

        return response()->json(['status' => 'success']);
    }

    public function websiteClick($id)
    {
        ListingTrackingService::track($id, 'website_click');

        return response()->json(['status' => 'success']);
    }

    public function whatsappClick($id)
    {
        ListingTrackingService::track($id, 'whatsapp_click');

        return response()->json(['status' => 'success']);
    }
}