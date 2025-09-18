<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <div class="grid grid-cols-1 p-4 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Total de Tarefas --}}
                <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-600 text-sm font-medium">Total de tarefas</p>
                            <p class="text-blue-900 text-3xl font-bold mt-2">{{App\Models\Task::totalTasks()}}</p>
                            <p class="text-gray-500 text-xs mt-1">Todas as suas tarefas</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-green-50 rounded-lg p-6 border border-green-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-600 text-sm font-medium">Concluídas</p>
                            <p class="text-green-900 text-3xl font-bold mt-2">{{App\Models\Task::finishedTasks()}}</p>
                            <p class="text-gray-500 text-xs mt-1">
                                Tarefas concluídas
                            </p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 rounded-lg p-6 border border-yellow-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-600 text-sm font-medium">Pendentes</p>
                            <p class="text-yellow-900 text-3xl font-bold mt-2">{{App\Models\Task::unfinishedTasks()}}</p>
                            <p class="text-gray-500 text-xs mt-1">Para completar</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-red-50 rounded-lg p-6 border border-red-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-600 text-sm font-medium">Vencidas</p>
                            <p class="text-red-900 text-3xl font-bold mt-2">{{App\Models\Task::overdueTasks()}}</p>
                            <p class="text-gray-500 text-xs mt-1">Precisam atenção</p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="bg-white rounded-lg border border-gray-200 mt-8">
                    <div class="p-8">
                        <h3 class="text-lg font-medium  mb-4">Ações Rápidas</h3>

                    </div>
                </div>



                <div class="bg-white rounded-lg border border-gray-200 mt-8">
                    <div class="p-8">
                        <h3 class="text-lg font-medium  mb-4">Ações Rápidas</h3>

                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
