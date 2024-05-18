<?php

namespace App\Http\Controllers;

use App\Models\Florminenc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class FlorminencController extends Controller
{
    public function index()
    {
        $dadosFlu = Florminenc::all();
        $contador = $dadosFlu->count();

        return response()->json(['contador' => $contador, 'dados' => $dadosFlu], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $dadosFlu = $request->all();
        $validarDados = Validator::make($dadosFlu, [
            'tecnico' => 'required',
            'titulos' => 'required',
            'jogabonito' => 'required',
            'campeonato_id' => 'required|exists:campeonatos,id',
        ]);

        if ($validarDados->fails()) {
            return response()->json(['errors' => $validarDados->errors()], Response::HTTP_BAD_REQUEST);
        }

        $fluCadastrar = Florminenc::create($dadosFlu);
        if ($fluCadastrar) {
            return response()->json(['message' => 'Dados cadastrados com sucesso'], Response::HTTP_CREATED);
        } else {
            return response()->json(['message' => 'Dados não cadastrados com sucesso'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $flu = Florminenc::find($id);

        if ($flu) {
            return response()->json($flu, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Florminenc não encontrado'], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request, $id)
    {
        $dadosFlu = $request->all();
        $validarDados = Validator::make($dadosFlu, [
            'tecnico' => 'required',
            'titulos' => 'required',
            'jogabonito' => 'required',
        ]);

        if ($validarDados->fails()) {
            return response()->json(['errors' => $validarDados->errors()], Response::HTTP_BAD_REQUEST);
        }

        $flu = Florminenc::find($id);
        if (!$flu) {
            return response()->json(['message' => 'Florminenc não encontrado'], Response::HTTP_NOT_FOUND);
        }

        $flu->update($dadosFlu);
        return response()->json(['message' => 'Dados atualizados com sucesso'], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $dadosFlu = Florminenc::find($id);

        if (!$dadosFlu) {
            return response()->json(['message' => 'Florminenc não encontrado'], Response::HTTP_NOT_FOUND);
        }

        $dadosFlu->delete();
        return response()->json(['message' => 'Florminenc deletado com sucesso'], Response::HTTP_NO_CONTENT);
    }
}
