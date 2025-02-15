<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            "ok" => true,
            "cargos" => Cargo::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // psersistir os dados
        $cargo = Cargo::create($request->all());

        // retornar os dados 
        return response()->json([
            "ok" => true,
            "cargo" => $cargo
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cargo $cargo)
    {
        return response()->json([
            "ok" => true,
            "cargo" => $cargo
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cargo $cargo)
    {
        $cargo->update($request->all());

        // retornar os dados 
        return response()->json([
            "message" => "cargo atualizado com sucesso",
            "cargo" => $cargo
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cargo $cargo)
    {
        //
        $cargo->delete($cargo);
        return response()->json([
            "message" => "cargo deletado com sucesso",
        ], 200);
    }
}
