<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Minhas Tarefas
            </h2>
            <a href="{{ route('tasks.create') }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg">
                Nova Tarefa
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4">
                <div class="bg-white rounded border border-gray-200 p-8 shadow-sm mb-6">
                    <form method="GET"
                          action="{{ route('tasks.index') }}"
                          class="space-y-4 md:space-y-0 md:flex md:items-end md:space-x-4">

                        <div class="flex-1">
                            <x-input-label for="status" value="Estado" />
                            <select name="status" id="status" class="w-full border-gray-300 rounded-md shadow-md">
                                <option value="">Todos os estados</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                    Pendentes
                                </option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                    Concluídas
                                </option>
                            </select>
                        </div>

                        <div class="flex-1">
                            <x-input-label for="priority" value="Prioridade" />
                            <select name="priority" id="priority" class="w-full border-gray-300 rounded-md shadow-md">
                                <option value="">Todas as prioridades</option>
                                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>
                                    Alta
                                </option>
                                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>
                                    Média
                                </option>
                                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>
                                    Baixa
                                </option>
                            </select>
                        </div>

                        <div class="flex-1">
                            <x-input-label for="date_filter" value="Data (Vencimento)" />
                            <select name="date_filter" id="date_filter" class="w-full border-gray-300 rounded-md shadow-md">
                                <option value="">Todas as datas</option>
                                <option value="overdue" {{ request('date_filter') == 'overdue' ? 'selected' : '' }}>
                                    Vencidas
                                </option>
                                <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>
                                    Hoje
                                </option>
                                <option value="week" {{ request('date_filter') == 'week' ? 'selected' : '' }}>
                                    Esta semana
                                </option>
                                <option value="no_date" {{ request('date_filter') == 'no_date' ? 'selected' : '' }}>
                                    Sem data
                                </option>
                            </select>
                        </div>

                        <div class="flex-1">
                            <x-input-label for="search" value="Pesquisar" />
                            <x-text-input name="search"
                                          id="search"
                                          value="{{ request('search') }}"
                                          placeholder="Título ou descrição..." class="w-full"/>
                        </div>

                        <div class="flex-1 flex space-x-2">
                            <x-primary-button type="submit">
                                Filtrar
                            </x-primary-button>

                            <x-link-button href="{{ route('tasks.index') }}">
                                Limpar
                            </x-link-button>
                        </div>
                    </form>
                </div>

                <div class="mb-4">
                    @if(!$tasks->hasPages())
                        <p class="text-sm text-gray-600 ">
                            Mostrando {{ $tasks->count() }} tarefa(s)
                        </p>
                    @endif
                </div>

                @forelse($tasks as $task)
                    <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-md">
                        <div class="flex items-start gap-3">

                            <form id="task-form-{{ $task->id }}" action="{{ route('tasks.toggle', $task) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="checkbox"
                                       {{ $task->completed ? 'checked' : '' }}
                                       onchange="toggleTask(event, {{ $task->id }})"
                                       class="w-4 h-4 mt-1 rounded">
                            </form>

                            <div class="flex-1">
                                <h3 id="task-title-{{ $task->id }}" class="font-semibold  {{ $task->completed ? 'line-through text-gray-500' : '' }}">
                                    {{ $task->title }}
                                </h3>

                                @if($task->description)
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ Str::limit($task->description, 100) }}
                                    </p>
                                @endif

                                <div class="flex items-center gap-3 mt-2 text-xs">

                                    <span class="px-2 py-1 rounded-full font-medium
                                        {{ $task->priority === 'high' ? 'bg-red-100 text-red-700' : '' }}
                                        {{ $task->priority === 'medium' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $task->priority === 'low' ? 'bg-green-100 text-green-700' : '' }}">
                                        {{ ucfirst($task->priority) }}
                                    </span>

                                    @if($task->due_date)
                                        <span class="text-gray-500">
                                            {{ $task->due_date->format('d/m/Y') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <button onclick="showTaskModal({{ $task->id }})"
                                    class="text-gray-600 hover:text-indigo-600 p-1"
                                    title="Ver detalhes">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>


                            <a href="{{ route('tasks.edit', $task) }}"
                               class="text-gray-600 hover:text-indigo-600 p-1">
                                <svg class="w-5 h-5 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Eliminar esta tarefa?')"
                                        class="text-gray-600 hover:text-red-600 p-1">
                                    <svg class="w-5 h-5 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>


                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="bg-white rounded-lg border border-gray-200 p-8 shadow-sm">
                            <h3 class="text-lg font-medium  mb-2">Nenhuma tarefa</h3>
                            <p class="text-gray-500">Não há tarefas para exibir.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($tasks->hasPages())
                <div class="mt-6">
                    {{ $tasks->links() }}
                </div>
            @endif
        </div>
    </div>

    {{--Component Modal--}}
    <x-task-modal />

    <script>
        function toggleTask(event, taskId) {

            const form = document.getElementById('task-form-' + taskId);
            const checkbox = form.querySelector('input[type="checkbox"]');
            const title = document.getElementById('task-title-' + taskId);

            checkbox.disabled = true;

            fetch(form.action, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(res => res.json())
                .then(data => {
                    checkbox.checked = data.completed;

                    if (data.completed) {
                        title.classList.add('line-through', 'text-gray-500');
                    } else {
                        title.classList.remove('line-through', 'text-gray-500');
                    }

                    checkbox.disabled = false;
                })
                .catch(err => {
                    console.error(err);
                    checkbox.disabled = false;
                });

            return false;
        }
    </script>
</x-app-layout>
