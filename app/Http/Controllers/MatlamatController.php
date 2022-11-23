<?php

namespace App\Http\Controllers;

use App\Models\MatlamatBulanan;
use App\Models\MatlamatTahunan;
use Illuminate\Http\Request;

class MatlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = MatlamatTahunan::all()->groupBy('tahun');

        return view('matlamat.index', [
            'matlamat' => $tahun,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = range(strftime("%Y", time()), 2050);

        return view('matlamat.create', [
            'tahuns' => $years,
            'tahun' => MatlamatTahunan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->jenis == 'tahun') {
            $m = MatlamatTahunan::create($request->all());
            activity()->event('CIPTA')->log('Matlamat tahun:' . $m->tahun . ' telah dicipta');
        }
        if ($request->jenis == 'bulan') {
            $m = MatlamatBulanan::create($request->all());
            activity()->event('CIPTA')->log('Matlamat bulan:' . $m->bulan . ' telah dicipta');
        }
        alert()->success('Berjaya', 'Data telah disimpan');

        return redirect()->route('matlamat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matlamatTahunan = MatlamatTahunan::with('bulan')->where('tahun', $id)->get();

        return view('matlamat.show', [
            'matlamatTahunan' => $matlamatTahunan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
