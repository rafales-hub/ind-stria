@extends('layouts.app')

@section('title','Cadastro de Chamado')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>Cadastrar Chamado</h1>

<form action="{{ route('chamados.store') }}" method="POST" class="container mt-4">
    @csrf

    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control">
    </div>

    <div class="mb-3">
        <label for="equipamento_id" class="form-label">Equipamento</label>

        <select name="equipamento_id" id="equipamento_id" class="form-control">
            @foreach($equipamentos as $equipamento)
                <option value="{{ $equipamento->id }}">
                    {{ $equipamento->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">
        Salvar
    </button>

</form>

@endsection