<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Funcionários</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h1>Funcionários</h1>

    <a href="{{ route('funcionarios.create') }}"
       class="btn btn-success mb-3">
        Novo Funcionário
    </a>

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
                        <a href="{{ route('funcionarios.edit', $funcionario) }}"class="btn btn-primary btn-sm">Editar</a> 
    <form
        action="{{ route('funcionarios.destroy', $funcionario) }}"
        method="POST"
        style="display:inline;"
    >

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="btn btn-danger btn-sm"
        >
            Excluir
        </button>

    </form>

</td>
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

</body>
</html>