<?php

namespace App\Http\Controllers;

use App\Models\Bagging;
use Illuminate\Http\Request;

class BaggingApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Bagging::all());
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

        $info = Bagging::create($request->all());
        if ($request->hasFile('url_gambar')) {
            $url = $request->file('url_gambar')->store(
                'bagging', 'public'
            );
            $info->update([
                'url_gambar' => $url,
            ]);
        }

        return response()->json($info);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bagging  $bagging
     * @return \Illuminate\Http\Response
     */
    public function show(Bagging $bagging)
    {
        return response()->json($bagging);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bagging  $bagging
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bagging $bagging)
    {
        $bagging->update($request->all());
        return response()->json($bagging);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bagging  $bagging
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bagging $bagging)
    {
        $bagging->delete();
        return [
            'Delete' => 'Successful',
        ];

    }
}
