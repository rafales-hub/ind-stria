@extends('layouts.app')

@section('title','Lista de Equipamentos')

@section('content')

<h1>Lista de Equipamentos</h1>

<!-- Formulário de Filtros com valor persistente -->
<form method="GET" action="{{ route('equipamentos.index') }}" class="mb-4">
    <div class="row">
        <!-- Input Nome -->
        <div class="col-md-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" 
                   name="nome" 
                   id="nome" 
                   class="form-control" 
                   value="{{ request('nome') }}" 
                   placeholder="Nome do equipamento">
        </div>

        <!-- Select Status -->
        <div class="col-md-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">Todos</option>
                <option value="ativo" @selected(request('status') == 'ativo')>Ativo</option>
                <option value="manutencao" @selected(request('status') == 'manutencao')>Manutenção</option>
                <option value="inativo" @selected(request('status') == 'inativo')>Inativo</option>
            </select>
        </div>

        <!-- Select Setor -->
        <div class="col-md-3">
            <label for="setor_id" class="form-label">Setor</label>
            <select name="setor_id" id="setor_id" class="form-select">
                <option value="">Todos os Setores</option>
                @foreach($setores as $setor)
                    <option value="{{ $setor->id }}" @selected(request('setor_id') == $setor->id)>
                        {{ $setor->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Input Patrimônio -->
        <div class="col-md-3">
            <label for="patrimonio" class="form-label">Patrimônio</label>
            <input type="text" 
                   name="patrimonio" 
                   id="patrimonio" 
                   class="form-control" 
                   value="{{ request('patrimonio') }}" 
                   placeholder="Patrimônio">
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary">Limpar</a>
    </div>
</form>

<!-- Exibição do Setor Selecionado (caso filtrado por setor) -->
@if(isset($setorSelecionado) && $setorSelecionado)
    <div class="alert alert-info">
        Exibindo equipamentos do setor: <strong>{{ $setorSelecionado->nome }}</strong>
    </div>
@endif

<a class="btn btn-primary mb-3" href="{{ route('equipamentos.create') }}">
    Novo
</a>

<table class="table">
    <thead class="table-info">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Patrimônio</th>
            <th>Setor</th>
            <th>Status</th>
            <th>Opções</th>
        </tr>
    </thead>

    <tbody>
        @foreach($equipamentos as $equipamento)
        <tr class="table-info">
            <td>{{ $equipamento->id }}</td>
            <td>{{ $equipamento->nome }}</td>
            <td>{{ $equipamento->patrimonio }}</td>
            <td>{{ $equipamento->setor->nome ?? $equipamento->setor_id }}</td>
            <td>{{ $equipamento->status }}</td>

            <td>
                <a class="btn btn-primary"
                   href="{{ route('equipamentos.show',$equipamento->id) }}">
                    Visualizar
                </a>

                <a class="btn btn-primary"
                   href="{{ route('equipamentos.edit',$equipamento->id) }}">
                    Editar
                </a>

                <form action="{{ route('equipamentos.destroy',$equipamento->id) }}"
                      method="POST"
                      style="display: inline-block;">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm">
                        Excluir
                    </button>
                </form>

                <form action="{{ route('equipamentos.ativar-desativar',$equipamento->id) }}"
                      method="POST"
                      style="display: inline-block;">
                    @csrf
                    @method('PATCH')

                    <button class="btn btn-warning btn-sm">
                        {{ $equipamento->status == 'ativo' ? 'Desativar' : 'Ativar' }}
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection