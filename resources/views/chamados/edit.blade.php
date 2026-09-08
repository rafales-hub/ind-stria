@extends('layouts.app')

@section('title','Editar Chamado')

@section('content')

<h1>Editar Chamado</h1>

<form action="{{ route('chamados.update', $chamado->id) }}" method="POST" class="container mt-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text"
               name="titulo"
               id="titulo"
               class="form-control"
               value="{{ $chamado->titulo }}">
    </div>

    <div class="mb-3">
        <label for="equipamento_id" class="form-label">Equipamento</label>

        <select name="equipamento_id" id="equipamento_id" class="form-control">
            @foreach($equipamentos as $equipamento)
                <option value="{{ $equipamento->id }}"
                    {{ $equipamento->id == $chamado->equipamento_id ? 'selected' : '' }}>
                    {{ $equipamento->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>

        <select name="status" id="status" class="form-control">
            <option value="aberto"
                {{ $chamado->status == 'aberto' ? 'selected' : '' }}>
                Aberto
            </option>

            <option value="fechado"
                {{ $chamado->status == 'fechado' ? 'selected' : '' }}>
                Fechado
            </option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">
        Salvar
    </button>

</form>

@endsection