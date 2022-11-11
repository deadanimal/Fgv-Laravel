<?php

namespace App\Http\Controllers;

use App\Models\StokPollen;
use Illuminate\Http\Request;

class StokPollenApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(StokPollen::all());
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
        $info = StokPollen::create($request->all());
        return response()->json($info);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StokPollen  $stokPollen
     * @return \Illuminate\Http\Response
     */
    public function show(StokPollen $stokPollen)
    {
        return response()->json($stokPollen);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StokPollen  $stokPollen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StokPollen $stokPollen)
    {
        $stokPollen->update($request->all());
        return response()->json($stokPollen);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StokPollen  $stokPollen
     * @return \Illuminate\Http\Response
     */
    public function destroy(StokPollen $stokPollen)
    {
        $stokPollen->delete();
        return [
            'Delete' => 'Successful',
        ];

    }
}
