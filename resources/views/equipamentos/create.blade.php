@extends('layouts.app')

@section('title','Cadastrar Equipamento')

@section('content')

<h1>Cadastrar Equipamento</h1>

<form action="{{ route('equipamentos.store') }}" method="POST" class="container mt-4">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Patrimônio</label>
        <input type="text" name="patrimonio" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Setor</label>

        <select name="setor_id" class="form-control">
            @foreach($setores as $setor)
                <option value="{{ $setor->id }}">
                    {{ $setor->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">
        Salvar
    </button>

</form>

@endsection