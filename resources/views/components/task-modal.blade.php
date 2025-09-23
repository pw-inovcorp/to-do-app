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

        <div id="error-content" style="display: none;" class="bg-red-100 border border-red-400 text-red-700 rounded p-4">
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
