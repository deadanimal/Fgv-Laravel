<?php

namespace App\Http\Controllers;

use App\Models\Pollen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PollenApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Pollen::with('pokok')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = Pollen::create($request->except(['url_gambar', 'url_gambar2']));

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
        $pollen->update($request->except(['url_gambar', 'url_gambar2']));

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
        $image_path = $pollen->url_gambar;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $image_path2 = $pollen->url_gambar2;
        if (File::exists($image_path2)) {
            File::delete($image_path2);
        }

        $pollen->delete();
        return [
            'Delete' => 'Successful',
        ];

    }
}
