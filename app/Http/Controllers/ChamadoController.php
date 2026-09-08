<?php

namespace App\Http\Controllers;
use App\Models\ChamadoManutencao;
use App\Models\Equipamento;      
;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chamados = ChamadoManutencao::where(
        'user_id',
        Auth::id()
        )->get();

    return view('chamados.index', compact('chamados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipamentos = Equipamento::all();
        return view('chamados.create', compact('equipamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
        'titulo' => 'required|max:150',
        'equipamento_id' => 'required|exists:equipamentos,id'
    ]);

    ChamadoManutencao::create([
        'titulo' => $request->titulo,
        'status' => 'aberto',
        'equipamento_id' => $request->equipamento_id,
        'user_id' => Auth::id()
    ]);

       return redirect()->route('chamados.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chamado = ChamadoManutencao::findOrFail($id);
    $equipamentos = Equipamento::all();

    return view('chamados.edit', compact('chamado', 'equipamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $chamado = ChamadoManutencao::findOrFail($id);

    $chamado->update([
        'titulo' => $request->titulo,
        'status' => $request->status,
        'equipamento_id' => $request->equipamento_id,
    ]);

    return redirect()->route('chamados.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
