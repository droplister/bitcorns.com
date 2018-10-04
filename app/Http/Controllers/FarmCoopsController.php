<?php

namespace App\Http\Controllers;

use App\Farm;
use Illuminate\Http\Request;
use App\Http\Requests\Farms\UpdateRequest;

class FarmCoopsController extends Controller
{
    /**
     * Update Coop
     *
     * @param  \App\Http\Requests\Farms\UpdateRequest  $request
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Farm $farm)
    {
        // Authenticate
        if ($error = $farm->validateSignature($request)) {
            return back()->with('error', $error);
        }

        // Update Coop
        if($request->has('leave')) {
            $farm->update(['coop_id' => null]);
        }else{
            $farm->update(['coop_id' => $request->coop]);
        }

        // Return Back
        return back()->with('success', 'Success - Update Complete!');
    }
}