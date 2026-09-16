<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Professor</title>
</head>
<body>

    <h1>Cadastrar Professor</h1>

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('professores.store') }}" method="POST">
        @csrf

        <div>
            <label for="nome">Nome:</label>
            <input
                type="text"
                name="nome"
                id="nome"
                value="{{ old('nome') }}"
            >
        </div>

        <br>

        <div>
            <label for="email">E-mail:</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
            >
        </div>

        <br>

        <div>
            <label for="titulacao">Titulação:</label>
            <input
                type="text"
                name="titulacao"
                id="titulacao"
                value="{{ old('titulacao') }}"
            >
        </div>

        <br>

        <button type="submit">Cadastrar</button>
    </form>

    <br>

    <a href="{{ route('professores.index') }}">Voltar</a>

</body>
</html>