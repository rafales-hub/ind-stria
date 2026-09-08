@extends('layouts.app')
@section('title', 'Lista de Funcionários')
@section('content')

<h1>Lista de Funcionários para {{ Auth::user()->name }}</h1>

<a href="{{ route('funcionarios.create') }}" class="btn btn-success mb-3">
    Novo Funcionário
</a>

{{-- FORMULÁRIO COM VALORES MANTIDOS APÓS A BUSCA --}}
<form action="{{ route('funcionarios.index') }}" method="GET" class="mb-4">
    <div class="row g-2 align-items-end">
        {{-- Campo Nome --}}
        <div class="col-md-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ request('nome') }}">
        </div>

        {{-- Campo Cargo --}}
        <div class="col-md-3">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" name="cargo" id="cargo" class="form-control" value="{{ request('cargo') }}">
        </div>

        {{-- Campo Setor (Marca 'selected' se o id for igual ao pesquisado) --}}
        <div class="col-md-3">
            <label for="setor_id" class="form-label">Setor</label>
            <select name="setor_id" id="setor_id" class="form-select">
                <option value="">Todos os setores</option>
                @foreach($setores as $setor)
                    <option value="{{ $setor->id }}" {{ request('setor_id') == $setor->id ? 'selected' : '' }}>
                        {{ $setor->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Campo Matrícula --}}
        <div class="col-md-2">
            <label for="matricula" class="form-label">Matrícula</label>
            <input type="text" name="matricula" id="matricula" class="form-control" value="{{ request('matricula') }}">
        </div>

        {{-- Botão Filtrar --}}
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </div>
</form>

{{-- Mensagem do setor selecionado via Setor::find() --}}
@if($setorSelecionado)
    <div class="alert alert-info">
        Exibindo funcionários do setor: <strong>{{ $setorSelecionado->nome }}</strong>
    </div>
@endif

{{-- Tabela de Listagem --}}
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Matrícula</th>
            <th>Cargo</th>
            <th>Setor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($funcionarios as $funcionario)
            <tr>
                <td>{{ $funcionario->nome }}</td>
                <td>{{ $funcionario->matricula }}</td>
                <td>{{ $funcionario->cargo }}</td>
                <td>{{ $funcionario->setor_id }}</td>
                <td>
                    <a href="{{ route('funcionarios.edit', $funcionario) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('funcionarios.destroy', $funcionario) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection