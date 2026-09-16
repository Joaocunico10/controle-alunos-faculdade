<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores</title>
</head>
<body>

    <h1>Professores</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('professores.create') }}">
        Cadastrar professor
    </a>

    <hr>

    @if($professores->isEmpty())
        <p>Nenhum professor cadastrado.</p>
    @else
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Titulação</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($professores as $professor)
                    <tr>
                        <td>{{ $professor->id }}</td>
                        <td>{{ $professor->nome }}</td>
                        <td>{{ $professor->email }}</td>
                        <td>{{ $professor->titulacao }}</td>

                        <td>
                            <a href="{{ route('professores.show', $professor) }}">
                                Visualizar
                            </a>

                            <a href="{{ route('professores.edit', $professor) }}">
                                Editar
                            </a>

                            <form
                                action="{{ route('professores.destroy', $professor) }}"
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