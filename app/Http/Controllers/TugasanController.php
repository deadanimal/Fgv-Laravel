<?php

namespace App\Http\Controllers;

use App\Models\Tandan;
use App\Models\Tugasan;
use App\Models\User;
use Illuminate\Http\Request;

class TugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tugasan.index', [
            'tugasans' => Tugasan::with('petugas')->orderByDesc('updated_at')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tugasan.create', [
            'tandans' => Tandan::all(),
            'users' => User::all(),
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
        Tugasan::create($request->all());
        alert()->success('Berjaya', 'Tugasan berjaya disimpan');
        activity()->event('Tugasan')->log('Tugasan Ditambah');
        return redirect()->route('pp.laporan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tugasan  $tugasan
     * @return \Illuminate\Http\Response
     */
    public function show(Tugasan $tugasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tugasan  $tugasan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tugasan $tugasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tugasan  $tugasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tugasan $tugasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tugasan  $tugasan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tugasan $tugasan)
    {
        //
    }
}
