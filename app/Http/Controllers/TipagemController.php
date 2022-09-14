<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipagemRequest;
use App\Http\Requests\UpdateTipagemRequest;
use App\Models\Tipagem;

class TipagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \App\Http\Requests\StoreTipagemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipagemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipagem  $tipagem
     * @return \Illuminate\Http\Response
     */
    public function show(Tipagem $tipagem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipagem  $tipagem
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipagem $tipagem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipagemRequest  $request
     * @param  \App\Models\Tipagem  $tipagem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipagemRequest $request, Tipagem $tipagem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipagem  $tipagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipagem $tipagem)
    {
        //
    }
}
