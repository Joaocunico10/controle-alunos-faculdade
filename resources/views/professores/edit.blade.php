<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Professor</title>
</head>
<body>

    <h1>Editar Professor</h1>

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('professores.update', $professor) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nome">Nome:</label>
            <input
                type="text"
                name="nome"
                id="nome"
                value="{{ old('nome', $professor->nome) }}"
            >
        </div>

        <br>

        <div>
            <label for="email">E-mail:</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email', $professor->email) }}"
            >
        </div>

        <br>

        <div>
            <label for="titulacao">Titulação:</label>
            <input
                type="text"
                name="titulacao"
                id="titulacao"
                value="{{ old('titulacao', $professor->titulacao) }}"
            >
        </div>

        <br>

        <button type="submit">Atualizar</button>
    </form>

    <br>

    <a href="{{ route('professores.index') }}">Voltar</a>

</body>
</html>