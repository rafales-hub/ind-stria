@extends('layouts.app')

@section('title','Lista de Equipamentos')

@section('content')

<h1>Lista de Equipamentos</h1>

<a class="btn btn-primary" href="{{ route('equipamentos.create') }}">
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
            <td>{{ $equipamento->setor_id }}</td>
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
                      method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm">
                        Excluir
                    </button>
                </form>

                <form action="{{ route('equipamentos.ativar-desativar',$equipamento->id) }}"
                      method="POST">
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