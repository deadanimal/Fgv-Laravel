<?php

namespace App\Http\Controllers;

use App\Models\Pokok;
use Illuminate\Http\Request;

class PokokApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Pokok::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = Pokok::create($request->all());
        return response()->json($info);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pokok  $pokok
     * @return \Illuminate\Http\Response
     */
    public function show(Pokok $pokok)
    {
        return response()->json($pokok);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pokok  $pokok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pokok $pokok)
    {
        $pokok->update($request->all());
        return response()->json($pokok);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pokok  $pokok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pokok $pokok)
    {
        $pokok->delete();
        return [
            'Delete' => 'Successful',
        ];

    }
}
