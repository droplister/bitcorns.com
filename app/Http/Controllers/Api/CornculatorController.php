<?php

namespace App\Http\Controllers\Api;

use App\Harvest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CornculatorController extends Controller
{
    /**
     * Calculate Harvest
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Simple Validation
        $request->validate([
            'crops' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

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
    }
}
