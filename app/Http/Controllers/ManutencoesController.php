<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manutencoes;
use App\Models\Funcionario;
use App\Models\Equipamento;

class ManutencoesController extends Controller
{
        public function index()
    {
        $manutencoes = Manutencoes::all();
        return view('manutencoes.index', compact('manutencoes'));
    }

    public function create()
    {
        $equipamentos = Equipamento::all();
        $funcionarios = Funcionario::all();
        return view('manutencoes.create', compact('equipamentos', 'funcionarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'funcionario_id' => 'required|exists:funcionarios,id',
            'tipo' => 'required|string|max:100',
            'descricao' => 'required|string|max:255',
            'data_manutencao' => 'required|date',
            'proxima_manutencao' => 'nullable|date',
            'status' => 'required|string|max:50',
            'custo' => 'required|numeric|min:0',
        ]);

        Manutencoes::create([
            'equipamento_id' => $request->equipamento_id,
            'funcionario_id' => $request->funcionario_id,
            'tipo' => $request->tipo,
            'descricao' => $request->descricao,
            'data_manutencao' => $request->data_manutencao,
            'proxima_manutencao' => $request->proxima_manutencao,
            'status' => $request->status,
            'custo' => $request->custo
        ]);
  
        return redirect()->route('manutencoes.index');
    }

    public function show(string $id)
    {
        $manutencao = Manutencoes::findOrFail($id);
        return view('manutencoes.show', compact('manutencao'));
    }


    public function edit(string $id)
    {
        $manutencao = Manutencoes::findOrFail($id);
        $equipamentos = Equipamento::all();
        $funcionarios = Funcionario::all();
        return view('manutencoes.edit', compact('manutencao', 'equipamentos', 'funcionarios'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'funcionario_id' => 'required|exists:funcionarios,id',
            'tipo' => 'required|string|max:100',
            'descricao' => 'required|string|max:255',
            'data_manutencao' => 'required|date',
            'proxima_manutencao' => 'nullable|date',
            'status' => 'required|string|max:50',
            'custo' => 'required|numeric|min:0',
        ]);

        $manutencao = Manutencoes::findOrFail($id);
        $manutencao->update([
            'equipamento_id' => $request->equipamento_id,
            'funcionario_id' => $request->funcionario_id,
            'tipo' => $request->tipo,
            'descricao' => $request->descricao,
            'data_manutencao' => $request->data_manutencao,
            'proxima_manutencao' => $request->proxima_manutencao,
            'status' => $request->status,
            'custo' => $request->custo
        ]);
        return redirect()->route('manutencoes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $manutencao = Manutencoes::findOrFail($id);
        $manutencao->delete();
        return redirect()->route('manutencoes.index');
    }

    public function alterarStatus (string $id)
    {
        $manutencao = Manutencoes::findOrFail($id);
        $manutencao->status = $manutencao->status === 'Pendente' ? 'Em andamento' :($manutencao->status === 'Em andamento' ? 'Concluída' : 'Pendente');
        $manutencao->save();

        return redirect()->route('manutencoes.index');
    }       
}
