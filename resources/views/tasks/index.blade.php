<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Minhas Tarefas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-4">
                @forelse($tasks as $task)
                    <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                        <div class="flex items-start gap-3">

                            <input type="checkbox"
                                   {{ $task->completed ? 'checked' : '' }}
                                   class="w-4 h-4 mt-1 rounded">

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
