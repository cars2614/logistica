<?php

namespace App\Http\Controllers;

use App\Models\ciudad;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ciudad = ciudad ::all();
        return view('ciudad.index',compact('ciudadades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('ciudad.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'nombre'      => 'required',
        'codigo_postal' => 'required',
        // agrega todos los campos de tu tabla ciudad
    ]);

    ciudad::create($request->all());
    return redirect()->route('ciudad.index')
                     ->with('success', 'Ciudad creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(ciudad $ciudad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ciudad $ciudad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ciudad $ciudad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ciudad $ciudad)
    {
        //
    }
}
