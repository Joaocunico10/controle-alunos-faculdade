<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor</title>
</head>
<body>

    <h1>Dados do Professor</h1>

    <p><strong>ID:</strong> {{ $professor->id }}</p>

    <p><strong>Nome:</strong> {{ $professor->nome }}</p>

    <p><strong>E-mail:</strong> {{ $professor->email }}</p>

    <p><strong>Titulação:</strong> {{ $professor->titulacao }}</p>

    <br>

    <a href="{{ route('professores.edit', $professor) }}">
        Editar
    </a>

    <br><br>

    <a href="{{ route('professores.index') }}">
        Voltar
    </a>

</body>
</html>