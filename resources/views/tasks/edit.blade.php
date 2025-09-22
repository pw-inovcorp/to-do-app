<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Tarefa
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg border border-gray-200 p-4 sm:p-6 shadow-md">
                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Título</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}" required
                               class="w-full rounded-lg border border-gray-300">
                        <x-input-error :messages="$errors->get('title')" class="mt-1" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Descrição</label>
                        <textarea name="description" rows="3"
                                  class="w-full rounded-lg border border-gray-300">{{ old('description', $task->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-1" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Data de vencimento</label>
                            <input type="date" name="due_date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            <x-input-error :messages="$errors->get('due_date')" class="mt-1" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Prioridade</label>
                            <select name="priority" required
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2">
                                <option value="low" {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>Baixa</option>
                                <option value="medium" {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>Média</option>
                                <option value="high" {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>Alta</option>
                            </select>
                            <x-input-error :messages="$errors->get('priority')" class="mt-1" />
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white justify-center">
                            Salvar Alterações
                        </x-primary-button>

                        <x-link-button href="{{ route('tasks.index') }}" class="justify-center">
                            Cancelar
                        </x-link-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
