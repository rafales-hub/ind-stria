@extends ('layouts.app')
@section('title','Lista de setores')
@section('content')


<h1> Lista de Setores para {{ Auth::user()->name }} </h1>

<form action="{{ route('setores.index') }}" method="get">
    @csrf
    <div class="d-flex">
        <label for="">id</label>
        <input type="text" name="id" id="id">
        <label for="">Status</label>
        <select name="status" id="status">
            <option value=""></option>
            <option value="1">Ativado</option>
            <option value="0">Desativado</option>
        </select>
        <label for="">Nome</label>
        <input type="text" name="nome" id="nome">
        <button class="btn btn-success" type="submit">Buscar</button>


    </div>
</form>




<a class="btn btn-primary" href="{{ route('setores.create') }}" role="button">Novo</a>

<table class="table">
    <thead class="table-info">
        <th>ID</th>
        <th>Nome</th>
        <th>Opções</th>
        <th>Status</th>
    </thead>
    <tbody>
        @foreach ( $setores as $setor)
        <tr class="table-info">
    <td>{{ $setor->id }}</td>
    <td>{{ $setor->nome }}</td>
    <td>{{ $setor->ativo ? 'Ativada' : 'Desativada' }}</td>
    <td>
        <a class="btn btn-primary" href="{{ route('setores.show',$setor->id) }}" role="button">Visualizar</a>
        <a class="btn btn-primary" href="{{ route('setores.edit',$setor->id) }}" role="button">Editar</a>
    <form action="{{ route('setores.destroy',$setor->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn sm">Excluir</button>
    </form>

    
    <form action="{{ route('setores.ativar-desativar',$setor->id) }}" method="post">
        @csrf
        @method('PATCH')
        <button class="btn btn-sm
                {{ $setor->ativo ? 'btn-warning' : 'btn-sucess' }}">
                {{ $setor->ativo ? 'Desativar' : 'Ativar' }}
        </button>
    </form>
    


    </td>
  
    
        @endforeach
        </tr>
    </tbody>
</table>
@endsection