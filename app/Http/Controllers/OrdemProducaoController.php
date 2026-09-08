<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordem_producao;
use App\Models\Funcionario;
use App\Models\Setor;

class OrdemProducaoController extends Controller
{

    public function index()
    {
        $ordens_producao = Ordem_producao::all();
        return view('ordens_producao.index', compact('ordens_producao'));
    }

    public function create()
    {
        $setores = Setor::all();
        $funcionarios = Funcionario::all();
        return view('ordens_producao.create', compact('setores', 'funcionarios'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'setor_id' => 'required|exists:setores,id',
            'funcionario_id' => 'required|exists:funcionarios,id',
            'codigo_ordem' => 'required|string|max:255',
            'produto' => 'required|string|max:255',
            'quantidade_planejada' => 'required|integer|min:1',
            'quantidade_produzida' => 'nullable|integer|min:0',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'status' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000'
        ]);

        Ordem_producao::create([
            'setor_id' => $request->setor_id,
            'funcionario_id' => $request->funcionario_id,
            'codigo_ordem' => $request->codigo_ordem,
            'produto' => $request->produto,
            'quantidade_planejada' => $request->quantidade_planejada,
            'quantidade_produzida' => $request->quantidade_produzida ?? 0,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
            'status' => $request->status,
            'descricao' => $request->descricao
        ]);

        return redirect()->route('ordens_producao.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ordem_producao = Ordem_producao::findOrFail($id);
        return view('ordens_producao.show', compact('ordem_producao'));
    }


    public function edit(string $id)
    {
        $ordem_producao = Ordem_producao::findOrFail($id);
        $setores = Setor::all();
        $funcionarios = Funcionario::all();
        return view('ordens_producao.edit', compact('ordem_producao', 'setores', 'funcionarios'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'setor_id' => 'required|exists:setores,id',
            'funcionario_id' => 'required|exists:funcionarios,id',
            'codigo_ordem' => 'required|string|max:255',
            'produto' => 'required|string|max:255',
            'quantidade_planejada' => 'required|integer|min:1',
            'quantidade_produzida' => 'nullable|integer|min:0',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'status' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000'
        ]);

        $ordem_producao = Ordem_producao::findOrFail($id);
        $ordem_producao->update([
            'setor_id' => $request->setor_id,
            'funcionario_id' => $request->funcionario_id,
            'codigo_ordem' => $request->codigo_ordem,
            'produto' => $request->produto,
            'quantidade_planejada' => $request->quantidade_planejada,
            'quantidade_produzida' => $request->quantidade_produzida ?? 0,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
            'status' => $request->status,
            'descricao' => $request->descricao
        ]);
        return redirect()->route('ordens_producao.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ordem_producao = Ordem_producao::findOrFail($id);
        $ordem_producao->delete();
        return redirect()->route('ordens_producao.index');
    }

      public function alterarStatus (string $id)
    {
        $ordem_producao = Ordem_producao::findOrFail($id);
        $ordem_producao->status = $ordem_producao->status === 'Aberta' ? 'Em Produção' :($ordem_producao->status === 'Em Produção' ? 'Finalizada' : 'Aberta');
        $ordem_producao->save();

    return redirect()->route('ordens_producao.index');
    }
}
