<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Funcionário</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h1>Editar Funcionário</h1>

    <form
        action="{{ route('funcionarios.update', $funcionario) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>

            <input
                type="text"
                name="nome"
                class="form-control"
                value="{{ $funcionario->nome }}"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Matrícula</label>

            <input
                type="text"
                name="matricula"
                class="form-control"
                value="{{ $funcionario->matricula }}"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Cargo</label>

            <input
                type="text"
                name="cargo"
                class="form-control"
                value="{{ $funcionario->cargo }}"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Setor</label>

            <select name="setor_id" class="form-select" required>

                @foreach ($setores as $setor)

                    <option
                        value="{{ $setor->id }}"
                        {{ $funcionario->setor_id == $setor->id ? 'selected' : '' }}
                    >
                        {{ $setor->nome }}
                    </option>

                @endforeach

            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Atualizar
        </button>

    </form>

</div>

</body>
</html>