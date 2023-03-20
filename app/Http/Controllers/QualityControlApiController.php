<?php

namespace App\Http\Controllers;

use App\Models\Kerosakan;
use App\Models\Pokok;
use App\Models\QualityControl;
use App\Models\Tandan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class QualityControlApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(QualityControl::with(['pokok'])->get());
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
        $info = QualityControl::create($request->all());
        if ($request->hasFile('url_gambar')) {
            $url = $request->file('url_gambar')->store(
                'qc', 'public'
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
     * @param  \App\Models\QualityControl  $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function show($qualityControl)
    {
        $q = QualityControl::with(['pokok'])->find($qualityControl);
        return response()->json($q);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QualityControl  $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QualityControl $qualityControl)
    {
        $qualityControl->update($request->except('url_gambar'));

        if ($request->hasFile('url_gambar')) {
            $url = $request->file('url_gambar')->store(
                'qc', 'public'
            );
            $qualityControl->update([
                'url_gambar' => $url,
            ]);
        }

        return response()->json($qualityControl);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QualityControl  $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(QualityControl $qualityControl)
    {
        $image_path = "public/" . $qualityControl->url_gambar;
        if (Storage::exists($image_path)) {
            Storage::delete($image_path);
        }

        $qualityControl->delete();
        return [
            'a' => $image_path,
            'Delete' => 'Successful',
        ];

    }

    public function multipleQC(Request $request)
    {
        if (!$request->user_id) {
            return [
                'code' => 404,
                'message' => "Sila Masukkan User ID (user_id)",
            ];
        }
        if ($request->pokok_id) {
            foreach ($request->pokok_id as $key => $pokok_id) {
                try {
                    $request->id[$key];
                    $adaId = true;
                } catch (\Throwable$th) {
                    $adaId = false;
                }
    
                if ($adaId) {
                    $qc[$key] = QualityControl::find($request->id[$key]);
                    if (!$qc[$key]) {
                        return [
                            'code' => 404,
                            'message' => "Id QC " . $qc[$key] . " not found",
                        ];
                    }
                    $qc[$key]->update([
                        "pokok_id" => $pokok_id,
                        "tandan_id" => $request->tandan_id[$key] ?? $qc[$key]->tandan_id,
                        "no_qc" => $request->no_qc[$key] ?? $qc[$key]->no_qc,
                        "kerosakan_id" => $request->kerosakan_id[$key] ?? $qc[$key]->kerosakan_id,
                        "status_bunga" => $request->status_bunga[$key] ?? $qc[$key]->status_bunga,
                        "status_qc" => $request->status_qc[$key] ?? $qc[$key]->status_qc,
                        "id_sv_qc" => $request->id_sv_qc[$key] ?? $qc[$key]->id_sv_qc,
                        "catatan" => $request->catatan[$key] ?? $qc[$key]->catatan,
                        "jum_bagging" => $request->jum_bagging[$key] ?? $qc[$key]->jum_bagging,
                        "jum_bagging_lulus" => $request->jum_bagging_lulus[$key] ?? $qc[$key]->jum_bagging_lulus,
                        "jum_bagging_rosak" => $request->jum_bagging_rosak[$key] ?? $qc[$key]->jum_bagging_rosak,
                        "peratus_rosak" => $request->peratus_rosak[$key] ?? $qc[$key]->peratus_rosak,
                        "pengesah_id" => $request->pengesah_id[$key] ?? $qc[$key]->pengesah_id,
                        "catatan_pengesah" => $request->catatan_pengesah[$key] ?? $qc[$key]->catatan_pengesah,
                        "status" => $request->status[$key] ?? $qc[$key]->status,
                    ]);

    
                } else {
                    $qc[$key] = QualityControl::create([
                        "pokok_id" => $pokok_id,
                        "tandan_id" => $request->tandan_id[$key] ?? null,
                        "no_qc" => $request->no_qc[$key] ?? null,
                        "kerosakan_id" => $request->kerosakan_id[$key] ?? null,
                        "status_bunga" => $request->status_bunga[$key] ?? null,
                        "status_qc" => $request->status_qc[$key] ?? null,
                        "id_sv_qc" => $request->id_sv_qc[$key] ?? null,
                        "catatan" => $request->catatan[$key] ?? null,
                        "jum_bagging" => $request->jum_bagging[$key] ?? null,
                        "jum_bagging_lulus" => $request->jum_bagging_lulus[$key] ?? null,
                        "jum_bagging_rosak" => $request->jum_bagging_rosak[$key] ?? null,
                        "peratus_rosak" => $request->peratus_rosak[$key] ?? null,
                        "pengesah_id" => $request->pengesah_id[$key] ?? null,
                        "catatan_pengesah" => $request->catatan_pengesah[$key] ?? null,
                        "status" => $request->status[$key] ?? null,
                    ]);

                }

                $qc[$key] = QualityControl::with(['pokok'])->where('id',$qc[$key]->id)->first();
    
            }
    
            if ($request->hasFile('url_gambar')) {
                foreach ($request->file('url_gambar') as $key => $value) {
    
                    $image_path = $qc[$key]->url_gambar;
                    if (Storage::exists("public/" . $image_path)) {
                        Storage::delete("public/" . $image_path);
                    }
    
                    $urlnew = $value->store(
                        'qc', 'public'
                    );
    
                    $qc[$key]->update([
                        'url_gambar' => $urlnew,
                    ]);
    
                }
    
            }
        }

        return [
            "QC" => $qc ?? null,
            "pokoks" => Pokok::all(),
            "tandans" => Tandan::all(),
            "korosakans" => Kerosakan::all(),
            "penyeliakk" => User::where('peranan', "Penyelia Kawalan Kualiti")->get(),
            "newQc" => QualityControl::with(['pokok'])->where('id_sv_qc', $request->user_id)->whereIn('status', ["dicipta", "tolak"])->get(),
        ];

    }
}
