<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinas</title>
</head>
<body>

    <h1>Disciplinas</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('disciplinas.create') }}">
        Cadastrar disciplina
    </a>

    <hr>

    @if($disciplinas->isEmpty())
        <p>Nenhuma disciplina cadastrada.</p>
    @else
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Código</th>
                    <th>Carga Horária</th>
                    <th>Professor</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($disciplinas as $disciplina)
                    <tr>
                        <td>{{ $disciplina->id }}</td>
                        <td>{{ $disciplina->nome }}</td>
                        <td>{{ $disciplina->codigo }}</td>
                        <td>{{ $disciplina->carga_horaria }} h</td>
                        <td>
                            {{ $disciplina->professor->nome ?? 'Sem professor' }}
                        </td>

                        <td>
                            <a href="{{ route('disciplinas.show', $disciplina) }}">
                                Visualizar
                            </a>

                            <a href="{{ route('disciplinas.edit', $disciplina) }}">
                                Editar
                            </a>

                            <form
                                action="{{ route('disciplinas.destroy', $disciplina) }}"
                                method="POST"
                                style="display:inline"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>