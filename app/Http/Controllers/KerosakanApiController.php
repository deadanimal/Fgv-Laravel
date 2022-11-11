<?php

namespace App\Http\Controllers;

use App\Models\Kerosakan;
use Illuminate\Http\Request;

class KerosakanApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Kerosakan::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = Kerosakan::create($request->all());
        return response()->json($info);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kerosakan  $kerosakan
     * @return \Illuminate\Http\Response
     */
    public function show(Kerosakan $kerosakan)
    {
        return response()->json($kerosakan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kerosakan  $kerosakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kerosakan $kerosakan)
    {
        $kerosakan->update($request->all());
        return response()->json($kerosakan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kerosakan  $kerosakan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kerosakan $kerosakan)
    {
        $kerosakan->delete();
        return [
            'Delete' => 'Successful',
        ];
    }
}
