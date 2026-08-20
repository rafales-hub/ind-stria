@extends ('layouts.app')
@section('title','Visualizar de setor')
@section('content')

<h1> Visualizar Setor </h1>

<p>Id: {{ $setor->id }}</p>
<p>Nome: {{ $setor->nome }}</p>


@endsection