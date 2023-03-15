<?php

namespace App\Http\Controllers;

use App\Models\Harvest;
use App\Models\Kerosakan;
use App\Models\Pokok;
use App\Models\Tandan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $image_path = $harvest->url_gambar;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $harvest->delete();
        return [
            'Delete' => 'Successful',
        ];

    }

    public function jumlahTuaiSetiapUser()
    {
        return User::withCount('harvest')->get();
    }

    public function FunctionName(Request $request)
    {
        if (!$request->user_id) {
            return [
                'code' => 404,
                'message' => "Sila Masukkan User ID (user_id)",
            ];
        }
        foreach ($request->pokok_id as $key => $pokok_id) {
            if ($request->id) {
                if ($request->id[$key]) {
                    $harvest[$key] = Harvest::find($request->id[$key]);
                    if (!$harvest[$key]) {
                        return [
                            'code' => 404,
                            'message' => "Id Harvest " . $harvest[$key] . " not found",
                        ];
                    }
                    $harvest[$key]->update([
                        "pokok_id" => $pokok_id,
                        "tandan_id" => $request->tandan_id[$key] ?? $harvest[$key]->tandan_id,
                        "no_harvest" => $request->no_harvest[$key] ?? $harvest[$key]->no_harvest,
                        "kerosakan_id" => $request->kerosakan_id[$key] ?? $harvest[$key]->kerosakan_id,
                        "berat_tandan" => $request->berat_tandan[$key] ?? $harvest[$key]->berat_tandan,
                        "catatan" => $request->catatan[$key] ?? $harvest[$key]->catatan,
                        "pengesah_id" => $request->pengesah_id[$key] ?? $harvest[$key]->pengesah_id,
                        "catatan_pengesah" => $request->catatan_pengesah[$key] ?? $harvest[$key]->catatan_pengesah,
                        "jumlah_tandan" => $request->jumlah_tandan[$key] ?? $harvest[$key]->jumlah_tandan,
                        "status" => $request->status[$key] ?? $harvest[$key]->status,
                        "number_of_postponed_field" => $request->number_of_postponed_field[$key] ?? $harvest[$key]->number_of_postponed_field,
                        "tambah_hari" => $request->tambah_hari[$key] ?? $harvest[$key]->tambah_hari,
                        "status_bunga" => $request->status_bunga[$key] ?? $harvest[$key]->status_bunga,
                        "status_bunga" => $request->status_bunga[$key] ?? $harvest[$key]->status_bunga,

                    ]);
                }
            } else {
                $harvest[$key] = Harvest::create([
                    "pokok_id" => $pokok_id,
                    "tandan_id" => $request->tandan_id[$key] ?? null,
                    "no_harvest" => $request->no_harvest[$key] ?? null,
                    "kerosakan_id" => $request->kerosakan_id[$key] ?? null,
                    "berat_tandan" => $request->berat_tandan[$key] ?? null,
                    "catatan" => $request->catatan[$key] ?? null,
                    "pengesah_id" => $request->pengesah_id[$key] ?? null,
                    "catatan_pengesah" => $request->catatan_pengesah[$key] ?? null,
                    "jumlah_tandan" => $request->jumlah_tandan[$key] ?? null,
                    "status" => $request->status[$key] ?? null,
                    "number_of_postponed_field" => $request->number_of_postponed_field[$key] ?? null,
                    "tambah_hari" => $request->tambah_hari[$key] ?? null,
                    "status_bunga" => $request->status_bunga[$key] ?? null,
                    "status_bunga" => $request->status_bunga[$key] ?? null,
                ]);
            }

        }

        if ($request->hasFile('url_gambar')) {
            foreach ($request->file('url_gambar') as $key => $value) {

                $image_path = $harvest[$key]->url_gambar;
                if (Storage::exists("public/" . $image_path)) {
                    Storage::delete("public/" . $image_path);
                }

                $urlnew = $value->store(
                    'harvest', 'public'
                );

                $harvest[$key]->update([
                    'url_gambar' => $urlnew,
                ]);

            }

        }

        return [
            "harvest" => $harvest,
            "pokoks" => Pokok::all(),
            "tandans" => Tandan::all(),
            "korosakans" => Kerosakan::all(),
            "penyeliakk" => User::where('peranan', "Penyelia Tuai")->get(),
            "newHarvest" => Harvest::where('id_sv_harvest', $request->user_id)->whereIn('status', ["dicipta", "tolak"])->get(),
        ];

    }
}
