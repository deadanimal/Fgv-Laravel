<?php

namespace App\Http\Controllers;

use App\Models\Bagging;
use App\Models\ControlPollination;
use App\Models\Harvest;
use App\Models\Pollen;
use App\Models\QualityControl;
use App\Models\Tandan;
use Illuminate\Http\Request;

class TandanApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Tandan::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = Tandan::create($request->all());
        return response()->json($info);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tandan  $tandan
     * @return \Illuminate\Http\Response
     */
    public function show(Tandan $tandan)
    {
        return response()->json($tandan);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tandan  $tandan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tandan $tandan)
    {
        $tandan->update($request->all());
        return response()->json($tandan);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tandan  $tandan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tandan $tandan)
    {
        $tandan->delete();
        return [
            'Delete' => 'Successful',
        ];

    }

    public function findPollen($id_tandan)
    {
        $pollens = Pollen::where('tandan_id', $id_tandan)->get();
        return response()->json($pollens);
    }
    public function findBagging($id_tandan)
    {
        $bagging = Bagging::where('tandan_id', $id_tandan)->get();
        return response()->json($bagging);
    }
    public function findQc($id_tandan)
    {
        $qc = QualityControl::where('tandan_id', $id_tandan)->get();
        return response()->json($qc);
    }
    public function findCp($id_tandan)
    {
        $cp = ControlPollination::where('tandan_id', $id_tandan)->get();
        return response()->json($cp);
    }
    public function findHarvest($id_tandan)
    {
        $harvest = Harvest::where('tandan_id', $id_tandan)->get();
        return response()->json($harvest);
    }
}
