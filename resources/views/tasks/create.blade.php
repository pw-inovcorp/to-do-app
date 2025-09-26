<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nova Tarefa
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-task-form
                :action="route('tasks.store')"
                submit-text="Criar Tarefa"
            />
        </div>
    </div>
</x-app-layout>

