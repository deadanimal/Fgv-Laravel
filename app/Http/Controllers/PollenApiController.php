<?php

namespace App\Http\Controllers;

use App\Models\Pollen;
use Illuminate\Http\Request;

class PollenApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Pollen::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = Pollen::create($request->all());

        if ($request->hasFile('url_gambar')) {
            $url = $request->file('url_gambar')->store(
                'pollen', 'public'
            );
            $info->update([
                'url_gambar' => $url,
            ]);
        }
        if ($request->hasFile('url_gambar2')) {
            $url = $request->file('url_gambar2')->store(
                'pollen', 'public'
            );
            $info->update([
                'url_gambar2' => $url,
            ]);
        }

        return response()->json($info);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pollen  $pollen
     * @return \Illuminate\Http\Response
     */
    public function show(Pollen $pollen)
    {
        return response()->json($pollen);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pollen  $pollen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pollen $pollen)
    {
        $pollen->update($request->all());

        if ($request->hasFile('url_gambar')) {
            $url = $request->file('url_gambar')->store(
                'pollen', 'public'
            );
            $pollen->update([
                'url_gambar' => $url,
            ]);
        }
        if ($request->hasFile('url_gambar2')) {
            $url = $request->file('url_gambar2')->store(
                'pollen', 'public'
            );
            $pollen->update([
                'url_gambar2' => $url,
            ]);
        }

        return response()->json($pollen);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pollen  $pollen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pollen $pollen)
    {
        $pollen->delete();
        return [
            'Delete' => 'Successful',
        ];

    }
}
