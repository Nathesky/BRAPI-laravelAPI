<?php

namespace App\Http\Controllers;

use App\Models\Flamengo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class FlamengoController extends Controller
{
    public function index()
    {
        $dadosFla = Flamengo::all();
        $contador = $dadosFla->count();

        return response()->json(['contador' => $contador, 'dados' => $dadosFla], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $dadosFla = $request->all();
        $validarDados = Validator::make($dadosFla, [
            'tecnico' => 'required',
            'titulos' => 'required',
            'jogabonito' => 'required',
            'campeonato_id' => 'required|exists:campeonatos,id',
        ]);

        if ($validarDados->fails()) {
            return response()->json(['errors' => $validarDados->errors()], Response::HTTP_BAD_REQUEST);
        }

        $flaCadastrar = Flamengo::create($dadosFla);
        if ($flaCadastrar) {
            return response()->json(['message' => 'Dados cadastrados com sucesso'], Response::HTTP_CREATED);
        } else {
            return response()->json(['message' => 'Dados não cadastrados com sucesso'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $fla = Flamengo::find($id);

        if ($fla) {
            return response()->json($fla, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Flamengo não encontrado'], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request, $id)
    {
        $dadosFla = $request->all();
        $validarDados = Validator::make($dadosFla, [
            'tecnico' => 'required',
            'titulos' => 'required',
            'jogabonito' => 'required',
        ]);

        if ($validarDados->fails()) {
            return response()->json(['errors' => $validarDados->errors()], Response::HTTP_BAD_REQUEST);
        }

        $fla = Flamengo::find($id);
        if (!$fla) {
            return response()->json(['message' => 'Flamengo não encontrado'], Response::HTTP_NOT_FOUND);
        }

        $fla->update($dadosFla);
        return response()->json(['message' => 'Dados atualizados com sucesso'], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $dadosFla = Flamengo::find($id);

        if (!$dadosFla) {
            return response()->json(['message' => 'Flamengo não encontrado'], Response::HTTP_NOT_FOUND);
        }

        $dadosFla->delete();
        return response()->json(['message' => 'Flamengo deletado com sucesso'], Response::HTTP_NO_CONTENT);
    }
}
