<?php

namespace App\Http\Controllers;

use App\Models\Face;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DesignerController extends Controller
{
    public function index()
    {
        return Inertia::render('Designer/Index', []);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Face $face)
    {
        //
    }

    public function edit(Face $face)
    {
        //
    }

    public function update(Request $request, Face $face)
    {
        //
    }

    public function destroy(Face $face)
    {
        //
    }
}
