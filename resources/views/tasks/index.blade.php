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
                    <form method="GET" action="{{ route('tasks.index') }}" class="space-y-4 md:space-y-0 md:flex md:items-end md:space-x-4">

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
                        <p class="text-sm text-gray-600">
                            Mostrando {{ $tasks->count() }} tarefa(s)
                        </p>
                    @endif
                </div>

                @forelse($tasks as $task)
                    <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-md">
                        <div class="flex items-start gap-3">

                            <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="checkbox"
                                       {{ $task->completed ? 'checked' : '' }}
                                       onchange="this.form.submit()"
                                       class="w-4 h-4 mt-1 rounded">
                            </form>

                            <div class="flex-1">
                                <h3 class="font-semibold  {{ $task->completed ? 'line-through text-gray-500' : '' }}">
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

    <x-modal name="show-task" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">
                Detalhes da Tarefa
            </h2>

            <div id="loading" class="text-center py-4">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600 mx-auto mb-2"></div>
                <p class="text-gray-600">Carregando...</p>
            </div>

            <div id="task-content" style="display: none;">

                <div class="mb-4">
                    <h3 id="task-title" class="text-xl font-semibold text-gray-900"></h3>
                </div>

                <div class="flex gap-2 mb-4">
                    <span id="task-status" class="px-2 py-1 rounded-full text-xs font-medium"></span>
                    <span id="task-priority" class="px-2 py-1 rounded-full text-xs font-medium"></span>
                </div>

                <div id="description-section" class="mb-4" style="display: none;">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Descrição</h4>
                    <div class="bg-gray-100 rounded p-3">
                        <p id="task-description" class="text-sm"></p>
                    </div>
                </div>

                <div id="due-date-section" class="mb-4" style="display: none;">
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Data de Vencimento</h4>
                    <p id="task-due-date" class="text-sm"></p>
                </div>

                <div class="border-t pt-4 text-sm text-gray-500">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span>Criada: </span>
                            <span id="task-created"></span>
                        </div>
                        <div>
                            <span>Atualizada: </span>
                            <span id="task-updated"></span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">

                    <x-link-button href="#" id="edit-link" class="text-indigo-600 hover:text-indigo-700">
                        Editar Tarefa
                    </x-link-button>

                    <x-secondary-button x-on:click="$dispatch('close')">
                        Fechar
                    </x-secondary-button>
                </div>
            </div>

            <div id="error-content" style="display: none;" class="bg-red-100 border border-red-400 text-red-700 rounded">
                <p>Erro ao carregar os detalhes da tarefa.</p>
            </div>
        </div>
    </x-modal>

    <script>
        function showTaskModal(taskId) {

            window.dispatchEvent(new CustomEvent('open-modal', {
                detail: 'show-task'
            }));

            document.getElementById('loading').style.display = 'block';
            document.getElementById('task-content').style.display = 'none';
            document.getElementById('error-content').style.display = 'none';

            fetch(`/tasks/${taskId}`)
                .then(response => {
                    if (!response.ok) throw new Error('Erro na resposta');
                    return response.json();
                })
                .then(task => {
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('task-content').style.display = 'block';


                    document.getElementById('task-title').textContent = task.title;
                    document.getElementById('task-created').textContent = task.created_at;
                    document.getElementById('task-updated').textContent = task.updated_at;
                    document.getElementById('edit-link').href = `/tasks/${task.id}/edit`;

                    const statusEl = document.getElementById('task-status');
                    statusEl.textContent = task.completed_text;
                    statusEl.className = task.completed
                        ? 'px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700'
                        : 'px-2 py-1 rounded-full text-xs font-medium bg-gray-200 text-gray-700';

                    const priorityEl = document.getElementById('task-priority');
                    priorityEl.textContent = task.priority_label;
                    let priorityClass = 'px-2 py-1 rounded-full text-xs font-medium ';
                    if (task.priority === 'high') priorityClass += 'bg-red-100 text-red-700';
                    else if (task.priority === 'medium') priorityClass += 'bg-yellow-100 text-yellow-700';
                    else priorityClass += 'bg-green-100 text-green-700';
                    priorityEl.className = priorityClass;

                    if (task.description) {
                        document.getElementById('task-description').textContent = task.description;
                        document.getElementById('description-section').style.display = 'block';
                    } else {
                        document.getElementById('description-section').style.display = 'none';
                    }

                    if (task.due_date) {
                        document.getElementById('task-due-date').textContent = task.due_date;
                        document.getElementById('due-date-section').style.display = 'block';
                    } else {
                        document.getElementById('due-date-section').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('error-content').style.display = 'block';
                });
        }
    </script>
</x-app-layout>
