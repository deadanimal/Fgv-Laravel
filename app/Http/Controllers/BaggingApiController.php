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
        return response()->json(Bagging::with(['pokok'])->get());
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
    public function show($bagging)
    {
        $b = Bagging::with(['pokok'])->find($bagging);
        return response()->json($b);

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

    public function multipleBagging(Request $request)
    {

        foreach ($request->pokok_id as $key => $value) {

            $info[$key] = Bagging::create([
                "no_bagging" => $request->noBagging[$key] ?? null,
                "pokok_id" => $request->pokok_id[$key],
                "tandan_id" => $request->tandan_id[$key],
                "id_sv_balut" => $request->id_sv_balut[$key] ?? null,
                "catatan" => $request->catatan[$key] ?? null,
                "pengesah_id" => $request->pengesah_id[$key] ?? null,
                "catatan_pengesah" => $request->catatan_pengesah[$key] ?? null,
                "status" => $request->status[$key] ?? null,
            ]);

        }

        if ($request->hasFile('url_gambar')) {
            foreach ($request->file('url_gambar') as $key => $value) {
                $url = $value->store(
                    'bagging', 'public'
                );
            }

            $info[$key]->update([
                'url_gambar' => $url,
            ]);
        }

        return response()->json($info);

    }
}
