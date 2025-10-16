<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GooglePlacesController extends Controller
{
    public function getPlaceDetails(Request $request)
    {
        $request->validate([
            'place_id' => 'required|string',
        ]);

        $placeId = $request->input('place_id');
        $apiKey = config('services.google_places.key');

        $response = Http::withHeaders([
            'X-Goog-Api-Key' => $apiKey,
            'X-Goog-FieldMask' => 'id,displayName,formattedAddress,location,addressComponents',
        ])->get("https://places.googleapis.com/v1/places/{$placeId}");

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch place details'], 400);
        }

        $data = $response->json();

        // Optional: Save to DB here

        return response()->json($data);
    }
}
