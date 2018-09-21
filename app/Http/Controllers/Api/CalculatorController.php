<?php

namespace App\Http\Controllers\Api;

use Cache;
use App\Harvest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalculatorController extends Controller
{
    /**
     * Calculate Harvest
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Validation
        $request->validate([
            'crops' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        // Cache Slug
        $cache_slug = 'calculate_' . $request->crops;

        // Calculator
        return Cache::rememberForever($cache_slug, function () use ($request) {
            // Bitcorn Harvests
            $harvests = Harvest::get();

            // Build Up An Array
            $data = [];

            // Calculate Bitcorn
            foreach($harvests as $harvest)
            {
                $data[] = [
                    $harvest->scheduled_at->timestamp * 1000,
                    $harvest->calculateBitcorn($request->crops),
                ];
            }

            // Simple API Format
            return compact('data');
        });
    }
}
