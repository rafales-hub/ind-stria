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
    public function index()
    {
        $equipamentos = Equipamento::all();

        return view('equipamentos.index', compact('equipamentos'));
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
            'nome' => 'required|max:255'
        ]);

        Equipamento::create([
            'nome' => $request->nome,
            'ativo' => true
        ]);

        return redirect()->route('equipamentos.index');
}

    /**
     * Display the specified resource.
     */
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

    /**
     * Ativar ou desativar equipamento.
     */
   public function ativarDesativar(string $id)
{
    $equipamento = Equipamento::findOrFail($id);

    $equipamento->status =
        $equipamento->status == 'ativo'
        ? 'inativo'
        : 'ativo';

    $equipamento->save();

    return redirect()->route('equipamentos.index');
} 
}