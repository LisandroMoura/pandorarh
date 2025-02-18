<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Traits\FuncionarioRules;
use Illuminate\Support\Facades\Validator;

class FuncionarioController extends Controller
{
    use FuncionarioRules;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "ok" => true,
            "funcionarios" => Funcionario::orderBy('id', 'desc')->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // informar a data de admissão.
        $data = $request->all();
        $data['data_admissao'] = now();
        $data['status'] = 'Ativo';

        // validar os dados de inclusão de um funcionário
        $validator = Validator::make(
            $data,
            $this->storeRules(),
            $this->messages()
        );


        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // psersistir os dados
        $funcionario = Funcionario::create($data);

        // retornar os dados
        return response()->json([
            "ok" => true,
            "funcionario" => $funcionario
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Funcionario $funcionario)
    {
        return response()->json([
            "ok" => true,
            "funcionario" => $funcionario
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        // //validar
        $validator = Validator::make(
            $request->all(),
            $this->updateRules($funcionario),
            $this->messages()
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Atualizar os dados do funcionário com os dados validados
        $funcionario->update($request->all());


        // retornar os dados
        return response()->json([
            "message" => "funcionário atualizado com sucesso",
            "funcionario" => $funcionario
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete($funcionario);
        return response()->json([
            "message" => "funcionário deletado com sucesso",
        ], 200);
    }
}
