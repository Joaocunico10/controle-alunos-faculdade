<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Curso') }}: {{ $curso->nome }}
            </h2>

            <div class="flex gap-3">
                <a href="{{ route('cursos.edit', $curso) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Editar') }}
                </a>
                <a href="{{ route('cursos.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                            <dd class="mt-1 text-base">{{ $curso->nome }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Código') }}</dt>
                            <dd class="mt-1 text-base">{{ $curso->codigo }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Duração (semestres)') }}</dt>
                            <dd class="mt-1 text-base">{{ $curso->duracao_semestres }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Quantidade de alunos') }}</dt>
                            <dd class="mt-1 text-base">{{ $curso->alunos->count() }}</dd>
                        </div>
                    </dl>

                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('Alunos matriculados') }}</h3>

                        @if ($curso->alunos->isEmpty())
                            <p class="text-gray-500">{{ __('Nenhum aluno matriculado neste curso.') }}</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Nome') }}</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Matrícula') }}</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('E-mail') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($curso->alunos as $aluno)
                                        <tr>
                                            <td class="px-4 py-2">{{ $aluno->nome }}</td>
                                            <td class="px-4 py-2">{{ $aluno->matricula }}</td>
                                            <td class="px-4 py-2">{{ $aluno->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
