<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBaggingRequest;
use App\Http\Requests\UpdateBaggingRequest;
use App\Models\Bagging;

class BaggingController extends Controller
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
     * @param  \App\Http\Requests\StoreBaggingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBaggingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bagging  $bagging
     * @return \Illuminate\Http\Response
     */
    public function show(Bagging $bagging)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bagging  $bagging
     * @return \Illuminate\Http\Response
     */
    public function edit(Bagging $bagging)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBaggingRequest  $request
     * @param  \App\Models\Bagging  $bagging
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBaggingRequest $request, Bagging $bagging)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bagging  $bagging
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bagging $bagging)
    {
        //
    }
}
