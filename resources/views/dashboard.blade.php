<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="bg-blue-50 rounded-lg p-4 sm:p-6 border border-blue-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-600 text-sm font-medium">Total de tarefas</p>
                            <p class="text-blue-900 text-2xl sm:text-3xl font-bold mt-2">{{$totalTasks}}</p>
                            <p class="text-gray-500 text-xs mt-1">Todas as suas tarefas</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-lg flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-green-50 rounded-lg p-4 sm:p-6 border border-green-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-600 text-sm font-medium">Concluídas</p>
                            <p class="text-green-900 text-2xl sm:text-3xl font-bold mt-2">{{$finishedTasks}}</p>
                            <p class="text-gray-500 text-xs mt-1">Tarefas concluídas</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-lg flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 rounded-lg p-4 sm:p-6 border border-yellow-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-600 text-sm font-medium">Pendentes</p>
                            <p class="text-yellow-900 text-2xl sm:text-3xl font-bold mt-2">{{$unfinishedTasks}}</p>
                            <p class="text-gray-500 text-xs mt-1">Para completar</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-lg flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-red-50 rounded-lg p-4 sm:p-6 border border-red-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-600 text-sm font-medium">Vencidas</p>
                            <p class="text-red-900 text-2xl sm:text-3xl font-bold mt-2">{{$overdueTasks}}</p>
                            <p class="text-gray-500 text-xs mt-1">Precisam atenção</p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-lg flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="bg-white rounded-lg border border-gray-200">
                    <div class="p-4 sm:p-8">
                        <h3 class="text-lg font-medium mb-4">Ações Rápidas</h3>

                        <a href="{{ route('tasks.index') }}"
                           class="flex items-center p-3 rounded-lg bg-gray-50 hover:bg-gray-100 mb-4">
                            <svg class="w-5 h-5 text-gray-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm font-medium">Ver Todas as Tarefas</p>
                                <p class="text-sm text-gray-500 hidden sm:block">Visualizar e gerir todas as tarefas</p>
                            </div>
                        </a>

                        <a href="{{ route('tasks.create') }}"
                           class="flex items-center p-3 rounded-lg bg-indigo-50 hover:bg-indigo-100">
                            <svg class="w-5 h-5 text-indigo-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm font-medium">Criar Nova Tarefa</p>
                                <p class="text-sm text-gray-500 hidden sm:block">Adicionar uma nova tarefa à sua lista</p>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200">
                    <div class="p-4 sm:p-8">
                        <h3 class="text-lg font-medium mb-4">Tarefas Recentes</h3>
                        <div class="space-y-3">

                            @if($tasks->count() > 0)
                                <ul class="list-disc list-inside space-y-6 text-sm">
                                    @foreach($tasks as $task)
                                        <li class="cursor-pointer hover:text-indigo-600 transition-colors"
                                            onclick="showTaskModal({{ $task->id }})">
                                            {{ Str::limit($task->title, 40) }}
                                        </li>
                                    @endforeach
                                </ul>

                            @else
                                <p class="text-sm text-gray-500">
                                    Nenhuma tarefa criada.
                                    <a href="{{ route('tasks.create') }}" class="text-indigo-600 hover:text-indigo-700">
                                        Criar agora
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    {{--Component Modal--}}
    <x-task-modal />
</x-app-layout>
