<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Aluno') }}: {{ $aluno->nome }}
            </h2>

            <div class="flex gap-3">
                <a href="{{ route('alunos.edit', $aluno) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Editar') }}
                </a>
                <a href="{{ route('alunos.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Voltar') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Nome') }}</dt>
                            <dd class="mt-1 text-base">{{ $aluno->nome }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('CPF') }}</dt>
                            <dd class="mt-1 text-base">{{ $aluno->cpf }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('E-mail') }}</dt>
                            <dd class="mt-1 text-base">{{ $aluno->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Matrícula') }}</dt>
                            <dd class="mt-1 text-base">{{ $aluno->matricula }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Data de nascimento') }}</dt>
                            <dd class="mt-1 text-base">{{ $aluno->data_nascimento->format('d/m/Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Curso') }}</dt>
                            <dd class="mt-1 text-base">{{ $aluno->curso->nome }} ({{ $aluno->curso->codigo }})</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
