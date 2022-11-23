<?php

namespace App\Http\Controllers;

use App\Models\Harvest;
use Illuminate\Http\Request;

class HarvestApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Harvest::with('pokok')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = Harvest::create($request->except('url_gambar'));

        if ($request->hasFile('url_gambar')) {
            $url = $request->file('url_gambar')->store(
                'harvest', 'public'
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
     * @param  \App\Models\Harvest  $harvest
     * @return \Illuminate\Http\Response
     */
    public function show($harvest)
    {
        $h = Harvest::with(['pokok'])->find($harvest);
        return response()->json($h);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Harvest  $harvest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Harvest $harvest)
    {
        $harvest->update($request->except('url_gambar'));

        if ($request->hasFile('url_gambar')) {
            $url = $request->file('url_gambar')->store(
                'harvest', 'public'
            );
            $harvest->update([
                'url_gambar' => $url,
            ]);
        }

        return response()->json($harvest);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Harvest  $harvest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Harvest $harvest)
    {
        $harvest->delete();
        return [
            'Delete' => 'Successful',
        ];

    }
}
