@extends('layouts.app')

@section('title','Lista de Chamados')

@section('content')

<h1>Lista de Chamados para {{ Auth::user()->name }}</h1>

<a class="btn btn-primary" href="{{ route('chamados.create') }}" role="button">
    Novo Chamado
</a>

<table class="table">
    <thead class="table-info">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Status</th>
            <th>Equipamento</th>
            <th>Opções</th>
        </tr>
    </thead>

    <tbody>
        @foreach($chamados as $chamado)
        <tr class="table-info">
            <td>{{ $chamado->id }}</td>
            <td>{{ $chamado->titulo }}</td>
            <td>{{ $chamado->status }}</td>

            <td>
                {{ $chamado->equipamento->nome ?? 'Sem equipamento' }}
            </td>

            <td>
                <a class="btn btn-primary"
                   href="{{ route('chamados.show', $chamado->id) }}">
                   Visualizar
                </a>

                <a class="btn btn-primary"
                   href="{{ route('chamados.edit', $chamado->id) }}">
                   Editar
                </a>

                <form action="{{ route('chamados.destroy', $chamado->id) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm">
                        Excluir
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection