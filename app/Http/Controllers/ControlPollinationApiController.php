<?php

namespace App\Http\Controllers;

use App\Models\ControlPollination;
use App\Models\Tandan;
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
        $info = ControlPollination::create($request->except('url_gambar'));
        $url = $info->url_gambar;
        if ($request->hasFile('url_gambar')) {
            foreach ($request->url_gambar as $g) {
                $urlnew = $g->store(
                    'cp', 'public'
                );
                if ($url == null) {
                    $url = $urlnew;
                } else {
                    $url = $url . ',' . $urlnew;
                }
            }
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

        $url = $controlPollination->url_gambar;
        if ($request->hasFile('url_gambar')) {
            foreach ($request->url_gambar as $g) {
                $urlnew = $g->store(
                    'cp', 'public'
                );
                if ($url == null) {
                    $url = $urlnew;
                } else {
                    $url = $url . ',' . $urlnew;
                }
            }
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

    public function multipleCP(Request $request)
    {
        if (!$request->pokok_id) {
            return [
                'cp' => null,
            ];
        }
        foreach ($request->pokok_id as $key => $pokok_id) {
            try {
                $request->id[$key];
                $adaId = true;
            } catch (\Throwable$th) {
                $adaId = false;
            }
            if ($adaId) {
                $cp[$key] = ControlPollination::find($request->id[$key]);
                if (!$cp[$key]) {
                    return [
                        'code' => 404,
                        'message' => "Id CP " . $cp[$key] . " not found",
                    ];
                }
                $cp[$key]->update([
                    "pokok_id" => $pokok_id,
                    "tandan_id" => $request->tandan_id[$key] ?? $cp[$key]->tandan_id,
                    "no_cp" => $request->no_cp[$key] ?? $cp[$key]->no_cp,
                    "kerosakan_id" => $request->kerosakan_id[$key] ?? $cp[$key]->kerosakan_id,
                    "bil_pemeriksaan" => $request->bil_pemeriksaan[$key] ?? $cp[$key]->bil_pemeriksaan,
                    "tambahan_hari" => $request->tambahan_hari[$key] ?? $cp[$key]->tambahan_hari,
                    "no_pollen" => $request->no_pollen[$key] ?? $cp[$key]->no_pollen,
                    "peratus_pollen" => $request->peratus_pollen[$key] ?? $cp[$key]->peratus_pollen,
                    "id_sv_cp" => $request->id_sv_cp[$key] ?? $cp[$key]->id_sv_cp,
                    "catatan" => $request->catatan[$key] ?? $cp[$key]->catatan,
                    "pengesah_id" => $request->pengesah_id[$key] ?? $cp[$key]->pengesah_id,
                    "catatan_pengesah" => $request->catatan_pengesah[$key] ?? $cp[$key]->catatan_pengesah,
                    "status" => $request->status[$key] ?? $cp[$key]->status,
                ]);

            } else {
                $cp[$key] = ControlPollination::create([
                    "pokok_id" => $pokok_id,
                    "tandan_id" => $request->tandan_id[$key] ?? null,
                    "no_cp" => $request->no_cp[$key] ?? null,
                    "kerosakan_id" => $request->kerosakan_id[$key] ?? null,
                    "bil_pemeriksaan" => $request->bil_pemeriksaan[$key] ?? null,
                    "tambahan_hari" => $request->tambahan_hari[$key] ?? null,
                    "no_pollen" => $request->no_pollen[$key] ?? null,
                    "peratus_pollen" => $request->peratus_pollen[$key] ?? null,
                    "id_sv_cp" => $request->id_sv_cp[$key] ?? null,
                    "catatan" => $request->catatan[$key] ?? null,
                    "pengesah_id" => $request->pengesah_id[$key] ?? null,
                    "catatan_pengesah" => $request->catatan_pengesah[$key] ?? null,
                    "status" => $request->status[$key] ?? null,
                ]);
            }
            try {
                Tandan::find($request->tandan_id[$key])->update([
                    'status_tandan' => "aktif",
                    'kitaran' => "debung",
                ]);

            } catch (\Throwable$th) {
            }

        }

        if ($request->hasFile('url_gambar')) {
            foreach ($request->file('url_gambar') as $key => $value) {

                $urlnew = $value->store(
                    'cp', 'public'
                );

                $url = $cp[$key]->url_gambar;
                if ($url == null) {
                    $url = $urlnew;
                } else {
                    $url = $url . ',' . $urlnew;
                }

                $cp[$key]->update([
                    'url_gambar' => $url,
                ]);

            }

        }

        return [
            "cp" => $cp,
        ];
    }
}
