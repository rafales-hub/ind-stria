<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Setor;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
   public function index()
    {
    $funcionarios = Funcionario::all();
    return view('funcionarios.index', compact('funcionarios'));
    }

    public function create()
    {
        $setores = Setor::all();

        return view('funcionarios.create', compact('setores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'matricula' => 'required|unique:funcionarios,matricula',
            'cargo' => 'required',
            'setor_id' => 'required',
        ]);

        Funcionario::create($request->all());

        return redirect()->route('funcionarios.index');
    }

    public function show(Funcionario $funcionario)
    {
        //
    }

    public function edit(Funcionario $funcionario)
{
    $setores = Setor::all();

    return view('funcionarios.edit', compact('funcionario', 'setores'));
}

public function update(Request $request, Funcionario $funcionario)
{
    $request->validate([
        'nome' => 'required',
        'matricula' => 'required|unique:funcionarios,matricula,' . $funcionario->id,
        'cargo' => 'required',
        'setor_id' => 'required',
    ]);

    $funcionario->update($request->all());

    return redirect()->route('funcionarios.index');
}

    public function destroy(Funcionario $funcionario)
    {
         $funcionario->delete();
        return redirect()->route('funcionarios.index');
    }
}


