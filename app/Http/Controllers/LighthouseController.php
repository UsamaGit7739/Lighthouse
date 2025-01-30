<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LighthouseController extends Controller
{
    public function getPerformanceScore(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'platform' => 'required|in:mobile,desktop'
        ]);

        $platform = $request->platform === 'mobile' ? 'mobile' : 'desktop';
        $apiUrl = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={$request->url}&strategy={$platform}";

        $response = Http::get($apiUrl);
        $data = $response->json();

        return response()->json([
            'performance_score' => $data['lighthouseResult']['categories']['performance']['score'] * 100
        ]);
    }
}
