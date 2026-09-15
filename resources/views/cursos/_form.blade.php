<div>
    <x-input-label for="nome" value="{{ __('Nome') }}" />
    <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" value="{{ old('nome', $curso->nome ?? '') }}" required autofocus />
    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="codigo" value="{{ __('Código') }}" />
    <x-text-input id="codigo" name="codigo" type="text" class="mt-1 block w-full" value="{{ old('codigo', $curso->codigo ?? '') }}" required />
    <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="duracao_semestres" value="{{ __('Duração (semestres)') }}" />
    <x-text-input id="duracao_semestres" name="duracao_semestres" type="number" min="1" max="20" class="mt-1 block w-full" value="{{ old('duracao_semestres', $curso->duracao_semestres ?? '') }}" required />
    <x-input-error :messages="$errors->get('duracao_semestres')" class="mt-2" />
</div>
