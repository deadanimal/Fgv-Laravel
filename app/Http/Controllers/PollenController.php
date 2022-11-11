<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePollenRequest;
use App\Http\Requests\UpdatePollenRequest;
use App\Models\Pollen;

class PollenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePollenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePollenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pollen  $pollen
     * @return \Illuminate\Http\Response
     */
    public function show(Pollen $pollen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pollen  $pollen
     * @return \Illuminate\Http\Response
     */
    public function edit(Pollen $pollen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePollenRequest  $request
     * @param  \App\Models\Pollen  $pollen
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePollenRequest $request, Pollen $pollen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pollen  $pollen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pollen $pollen)
    {
        //
    }
}
