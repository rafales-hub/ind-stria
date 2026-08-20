@extends('layouts.app')

@section('title','Visualizar Equipamento')

@section('content')

<h1>Visualizar Equipamento</h1>

<p><strong>ID:</strong> {{ $equipamento->id }}</p>

<p><strong>Nome:</strong> {{ $equipamento->nome }}</p>

<p><strong>Patrimônio:</strong> {{ $equipamento->patrimonio }}</p>

<p><strong>Setor ID:</strong> {{ $equipamento->setor_id }}</p>

<p><strong>Status:</strong> {{ $equipamento->status }}</p>

@endsection