<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Setor;
use Illuminate\Http\Request;

class EquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Consulta base com condição sempre verdadeira
        $equipamentos = Equipamento::where('id', '>', 0);

        // Filtro por Nome
        if ($request->filled('nome')) {
            $equipamentos = $equipamentos->where('nome', 'like', '%' . $request->nome . '%');
        }

        // Filtro por Status
        if ($request->filled('status')) {
            $equipamentos = $equipamentos->where('status', $request->status);
        }

        // Filtro por Setor
        if ($request->filled('setor_id')) {
            $equipamentos = $equipamentos->where('setor_id', $request->setor_id);
        }

        // Filtro por Patrimônio
        if ($request->filled('patrimonio')) {
            $equipamentos = $equipamentos->where('patrimonio', 'like', '%' . $request->patrimonio . '%');
        }

        // Executa a consulta
        $equipamentos = $equipamentos->get();

        // Busca o setor selecionado para exibir o nome na tela
        $setorSelecionado = $request->filled('setor_id') ? Setor::find($request->setor_id) : null;

        // Busca todos os setores para popular o <select> do formulário de filtro
        $setores = Setor::all();

        return view('equipamentos.index', compact('equipamentos', 'setorSelecionado', 'setores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setores = Setor::all();

        return view('equipamentos.create', compact('setores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'patrimonio' => 'required|string|unique:equipamentos,patrimonio|max:255',
            'setor_id' => 'required|exists:setores,id'
        ]);

        Equipamento::create([
            'nome' => $request->nome,
            'patrimonio' => $request->patrimonio,
            'setor_id' => $request->setor_id,
            'status' => 'ativo'
        ]);

        return redirect()->route('equipamentos.index');
    }

    public function show(string $id)
    {
        $equipamento = Equipamento::findOrFail($id);
        return view('equipamentos.show', compact('equipamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $equipamento = Equipamento::findOrFail($id);
        $setores = Setor::all();

        return view('equipamentos.edit', compact('equipamento', 'setores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $equipamento = Equipamento::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'patrimonio' => 'required|string|max:255|unique:equipamentos,patrimonio,' . $id,
            'setor_id' => 'required|exists:setores,id'
        ]);

        $equipamento->update([
            'nome' => $request->nome,
            'patrimonio' => $request->patrimonio,
            'setor_id' => $request->setor_id
        ]);

        return redirect()->route('equipamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipamento = Equipamento::findOrFail($id);

        $equipamento->delete();

        return redirect()->route('equipamentos.index');
    }

    public function ativarDesativar(string $id)
    {
        $equipamento = Equipamento::findOrFail($id);
        $equipamento->status = $equipamento->status === 'ativo' ? 'inativo' : 'ativo';
        $equipamento->save();
        return redirect()->route('equipamentos.index');
    }
}