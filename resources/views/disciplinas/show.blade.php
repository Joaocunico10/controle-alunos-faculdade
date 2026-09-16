<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplina</title>
</head>
<body>

    <h1>Dados da Disciplina</h1>

    <p><strong>ID:</strong> {{ $disciplina->id }}</p>

    <p><strong>Nome:</strong> {{ $disciplina->nome }}</p>

    <p><strong>Código:</strong> {{ $disciplina->codigo }}</p>

    <p><strong>Carga Horária:</strong> {{ $disciplina->carga_horaria }} h</p>

    <p>
        <strong>Professor responsável:</strong>
        {{ $disciplina->professor->nome ?? 'Sem professor' }}
    </p>

    <br>

    <a href="{{ route('disciplinas.edit', $disciplina) }}">
        Editar
    </a>

    <br><br>

    <a href="{{ route('disciplinas.index') }}">
        Voltar
    </a>

</body>
</html>