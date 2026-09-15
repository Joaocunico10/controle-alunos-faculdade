<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Alunos') }}
            </h2>

            <a href="{{ route('alunos.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Novo Aluno') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            @if (session('status') === 'aluno-criado')
                                {{ __('Aluno criado com sucesso.') }}
                            @elseif (session('status') === 'aluno-atualizado')
                                {{ __('Aluno atualizado com sucesso.') }}
                            @elseif (session('status') === 'aluno-removido')
                                {{ __('Aluno removido com sucesso.') }}
                            @endif
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Nome') }}</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Matrícula') }}</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('E-mail') }}</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Curso') }}</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">{{ __('Ações') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($alunos as $aluno)
                                <tr>
                                    <td class="px-4 py-2">{{ $aluno->nome }}</td>
                                    <td class="px-4 py-2">{{ $aluno->matricula }}</td>
                                    <td class="px-4 py-2">{{ $aluno->email }}</td>
                                    <td class="px-4 py-2">{{ $aluno->curso->nome }}</td>
                                    <td class="px-4 py-2 text-right whitespace-nowrap">
                                        <a href="{{ route('alunos.show', $aluno) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Ver') }}</a>
                                        <a href="{{ route('alunos.edit', $aluno) }}" class="ms-3 text-gray-600 hover:text-gray-900">{{ __('Editar') }}</a>
                                        <form action="{{ route('alunos.destroy', $aluno) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Tem certeza que deseja excluir este aluno?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ms-3 text-red-600 hover:text-red-900">{{ __('Excluir') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">{{ __('Nenhum aluno cadastrado.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $alunos->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
