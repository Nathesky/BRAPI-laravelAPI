<?php

namespace App\Http\Controllers;

use App\Models\Campeonato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CampeonatoController extends Controller
{
    public function index()
    {
        $dadosCamp = Campeonato::all();
        $contador = $dadosCamp->count();

        return response()->json(['contador' => $contador, 'dados' => $dadosCamp], Response::HTTP_OK);
    }

    public function getClubes($id)
    {
        $camp = Campeonato::with(['flamengos', 'florminencs'])->find($id);

        if (!$camp) {
            return response()->json(['message' => 'Campeonato não encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($camp, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $dadosCamp = $request->all();
        $validarDados = Validator::make($dadosCamp, [
            'campeao' => 'required',
            'classificacao' => 'required',
            'clubes' => 'required',
        ]);

        if ($validarDados->fails()) {
            return response()->json(['errors' => $validarDados->errors()], Response::HTTP_BAD_REQUEST);
        }

        $campCadastrar = Campeonato::create($dadosCamp);
        if ($campCadastrar) {
            return response()->json(['message' => 'Dados cadastrados com sucesso'], Response::HTTP_CREATED);
        } else {
            return response()->json(['message' => 'Dados não cadastrados com sucesso'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $camp = Campeonato::find($id);

        if ($camp) {
            return response()->json($camp, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Campeonato não encontrado'], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request, $id)
    {
        $dadosCamp = $request->all();
        $validarDados = Validator::make($dadosCamp, [
            'campeao' => 'required',
            'classificacao' => 'required',
            'clubes' => 'required',
        ]);

        if ($validarDados->fails()) {
            return response()->json(['errors' => $validarDados->errors()], Response::HTTP_BAD_REQUEST);
        }

        $camp = Campeonato::find($id);
        if (!$camp) {
            return response()->json(['message' => 'Campeonato não encontrado'], Response::HTTP_NOT_FOUND);
        }

        $camp->update($dadosCamp);
        return response()->json(['message' => 'Dados atualizados com sucesso'], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $dadosCamp = Campeonato::find($id);

        if (!$dadosCamp) {
            return response()->json(['message' => 'Campeonato não encontrado'], Response::HTTP_NOT_FOUND);
        }

        $dadosCamp->delete();
        return response()->json(['message' => 'Campeonato deletado com sucesso'], Response::HTTP_NO_CONTENT);
    }
}
