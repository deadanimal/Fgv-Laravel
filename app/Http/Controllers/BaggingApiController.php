<?php

namespace App\Http\Controllers;

use App\Models\Bagging;
use App\Models\ControlPollination;
use App\Models\Kerosakan;
use App\Models\Pokok;
use App\Models\Pollen;
use App\Models\Tandan;
use App\Models\User;
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
        if (!$request->user_id) {
            return [
                'code' => 404,
                'message' => 'Sila masukkan data user_id',
            ];
        }
        if ($request->pokok_id) {
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

                $tandan[$key] = Tandan::find($request->tandan_id[$key])->update([
                    'kitaran' => 'balut',
                    'pokok_id' => $request->pokok_id[$key],
                    'tarikh_daftar' => now(),
                ]);
            }

            if ($request->hasFile('url_gambar')) {
                foreach ($request->file('url_gambar') as $key => $value) {
                    $url = $value->store(
                        'bagging', 'public'
                    );

                    $info[$key]->update([
                        'url_gambar' => $url,
                    ]);

                }

            }
        }

        $tandanIdInCp = ControlPollination::pluck('tandan_id')->toArray();
        $newCP = Bagging::where('id_sv_balut', $request->user_id)
            ->where('status', 'sah')
            ->whereNotIn('tandan_id', $tandanIdInCp)
            ->get();

        $posponedCP = ControlPollination::where('id_sv_cp', $request->user_id)
            ->whereIn('status', ['anjak', 'tolak'])
            ->get();

        $kerosakan = Kerosakan::all();

        $pollen = Pollen::where('status', 'sah')
            ->where('kerosakan_id', null)
            ->get();

        return response()->json([
            'bagging' => $info ?? [],
            'tandan' => Tandan::all(),
            'pokok' => Pokok::all(),
            'user' => User::where('peranan', "Penyelia Balut & Pendebungaan Terkawal")->get(),
            'newCP' => $newCP,
            'posponedCP' => $posponedCP,
            'kerosakan' => $kerosakan,
            'pollen' => $pollen,
        ]);

    }
}
