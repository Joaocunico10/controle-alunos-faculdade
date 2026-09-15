<div>
    <x-input-label for="nome" value="{{ __('Nome') }}" />
    <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" value="{{ old('nome', $aluno->nome ?? '') }}" required autofocus />
    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="cpf" value="{{ __('CPF') }}" />
    <x-text-input id="cpf" name="cpf" type="text" class="mt-1 block w-full" value="{{ old('cpf', $aluno->cpf ?? '') }}" required />
    <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="email" value="{{ __('E-mail') }}" />
    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $aluno->email ?? '') }}" required />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="matricula" value="{{ __('Matrícula') }}" />
    <x-text-input id="matricula" name="matricula" type="text" class="mt-1 block w-full" value="{{ old('matricula', $aluno->matricula ?? '') }}" required />
    <x-input-error :messages="$errors->get('matricula')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="data_nascimento" value="{{ __('Data de nascimento') }}" />
    <x-text-input id="data_nascimento" name="data_nascimento" type="date" class="mt-1 block w-full" value="{{ old('data_nascimento', isset($aluno) ? $aluno->data_nascimento->format('Y-m-d') : '') }}" required />
    <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="curso_id" value="{{ __('Curso') }}" />
    <select id="curso_id" name="curso_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
        <option value="">{{ __('Selecione um curso') }}</option>
        @foreach ($cursos as $curso)
            <option value="{{ $curso->id }}" @selected(old('curso_id', $aluno->curso_id ?? '') == $curso->id)>
                {{ $curso->nome }} ({{ $curso->codigo }})
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('curso_id')" class="mt-2" />
</div>
