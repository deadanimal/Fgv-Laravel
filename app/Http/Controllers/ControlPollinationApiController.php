<?php

namespace App\Http\Controllers;

use App\Models\ControlPollination;
use Illuminate\Http\Request;

class ControlPollinationApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ControlPollination::all());
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = ControlPollination::create($request->all());
        return response()->json($info);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ControlPollination  $controlPollination
     * @return \Illuminate\Http\Response
     */
    public function show(ControlPollination $controlPollination)
    {
        return response()->json($controlPollination);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ControlPollination  $controlPollination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ControlPollination $controlPollination)
    {
        $controlPollination->update($request->all());
        return response()->json($controlPollination);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ControlPollination  $controlPollination
     * @return \Illuminate\Http\Response
     */
    public function destroy(ControlPollination $controlPollination)
    {
        $controlPollination->delete();
        return [
            'Delete' => 'Successful',
        ];

    }
}
