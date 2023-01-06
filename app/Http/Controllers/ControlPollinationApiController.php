<?php

namespace App\Http\Controllers;

use App\Models\ControlPollination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ControlPollinationApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ControlPollination::with(['pokok'])->get());
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
        if ($request->hasFile('url_gambar')) {
            $url = $request->file('url_gambar')->store(
                'cp', 'public'
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
     * @param  \App\Models\ControlPollination  $controlPollination
     * @return \Illuminate\Http\Response
     */
    public function show($controlPollination)
    {
        $cp = ControlPollination::with(['pokok'])->find($controlPollination);
        return response()->json($cp);
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

        $controlPollination->update($request->except('url_gambar'));

        if ($request->hasFile('url_gambar')) {
            $url = $request->file('url_gambar')->store(
                'cp', 'public'
            );
            $controlPollination->update([
                'url_gambar' => $url,
            ]);
        }

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
        $image_path = $controlPollination->url_gambar;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $controlPollination->delete();
        return [
            'Delete' => 'Successful',
        ];

    }
}
