<?php

namespace App\Http\Controllers;

use App\Models\Tandan;
use Illuminate\Http\Request;

class TandanApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Tandan::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = Tandan::create($request->all());
        return response()->json($info);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tandan  $tandan
     * @return \Illuminate\Http\Response
     */
    public function show(Tandan $tandan)
    {
        return response()->json($tandan);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tandan  $tandan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tandan $tandan)
    {
        $tandan->update($request->all());
        return response()->json($tandan);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tandan  $tandan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tandan $tandan)
    {
        $tandan->delete();
        return [
            'Delete' => 'Successful',
        ];

    }
}
