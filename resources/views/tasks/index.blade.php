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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-4">
                @forelse($tasks as $task)
                    <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
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
                                        {{ $task->description }}
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
        </div>
    </div>
</x-app-layout>
