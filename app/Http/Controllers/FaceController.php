<?php

namespace App\Http\Controllers;

use App\Http\Crud\Face\CreateConfig;
use App\Http\Crud\Face\ListConfig;
use App\Models\Face;
use Illuminate\Http\Request;

class FaceController extends CrudController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respond('Crud/Index', new ListConfig(), 'face-read');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->respond('Crud/Create', new CreateConfig(), 'face-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Face  $face
     * @return \Illuminate\Http\Response
     */
    public function show(Face $face)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Face  $face
     * @return \Illuminate\Http\Response
     */
    public function edit(Face $face)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Face  $face
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Face $face)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Face  $face
     * @return \Illuminate\Http\Response
     */
    public function destroy(Face $face)
    {
        //
    }
}
