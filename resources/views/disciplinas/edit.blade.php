<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Disciplina</title>
</head>
<body>

    <h1>Editar Disciplina</h1>

    <form action="{{ route('disciplinas.update', $disciplina) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nome">Nome:</label>
            <input
                type="text"
                name="nome"
                id="nome"
                value="{{ $disciplina->nome }}"
            >
        </div>

        <br>

        <div>
            <label for="codigo">Código:</label>
            <input
                type="text"
                name="codigo"
                id="codigo"
                value="{{ $disciplina->codigo }}"
            >
        </div>

        <br>

        <div>
            <label for="carga_horaria">Carga Horária:</label>
            <input
                type="number"
                name="carga_horaria"
                id="carga_horaria"
                value="{{ $disciplina->carga_horaria }}"
            >
        </div>

        <br>

        <div>
            <label for="professor_id">Professor responsável:</label>

            <select name="professor_id" id="professor_id">
                @foreach($professores as $professor)
                    <option
                        value="{{ $professor->id }}"
                        {{ $disciplina->professor_id == $professor->id ? 'selected' : '' }}
                    >
                        {{ $professor->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <button type="submit">
            Atualizar
        </button>
    </form>

    <br>

    <a href="{{ route('disciplinas.index') }}">
        Voltar
    </a>

</body>
</html>