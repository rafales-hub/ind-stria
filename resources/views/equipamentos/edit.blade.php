@extends('layouts.app')

@section('title','Editar Equipamento')

@section('content')

<h1>Editar Equipamento</h1>

<form action="{{ route('equipamentos.update',$equipamento->id) }}"
      method="POST"
      class="container mt-4">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text"
               name="nome"
               class="form-control"
               value="{{ $equipamento->nome }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Patrimônio</label>
        <input type="text"
               name="patrimonio"
               class="form-control"
               value="{{ $equipamento->patrimonio }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Setor</label>
        <select name="setor_id" class="form-control">
            @foreach($setores as $setor)
                <option value="{{ $setor->id }}"
                    {{ $equipamento->setor_id == $setor->id ? 'selected' : '' }}>
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