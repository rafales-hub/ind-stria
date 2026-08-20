@extends ('layouts.app')
@section('title','Editar de setor')
@section('content')

<h1>Editar Setor</h1>

<form action="{{route('setores.update', $setor->id) }}" method="post" class="container mt-4">
    @csrf
    @method ("PUT")

    <div class="mb-3">
        <label for="" class="form-label">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" value="{{ $setor-> nome }}">
    </div>

    <button type="submit" class="btn btn-sucess">Salvar</button>


</form>

@endsection