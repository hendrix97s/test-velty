<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePredioRequest;
use App\Http\Requests\UpdatePredioRequest;
use App\Models\Predio;

class PredioController extends Controller
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
     * @param  \App\Http\Requests\StorePredioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePredioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Predio  $predio
     * @return \Illuminate\Http\Response
     */
    public function show(Predio $predio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Predio  $predio
     * @return \Illuminate\Http\Response
     */
    public function edit(Predio $predio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePredioRequest  $request
     * @param  \App\Models\Predio  $predio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePredioRequest $request, Predio $predio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Predio  $predio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Predio $predio)
    {
        //
    }
}
