<?php

use App\Models\User;
use App\Models\Task;


test('Usuário consegue ver o formulário de criar tarefas?', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('tasks.create'));

    $response->assertOk();
    $response->assertViewIs('tasks.create');
    $response->assertSee('Nova Tarefa');
});

test('Usuário pode criar uma tarefa com dados válidos?', function () {

    $user = User::factory()->create();
    $taskData = [
        'title' => 'Minha Nova Tarefa',
        'description' => 'Descrição da tarefa',
        'due_date' => now()->addDays(7)->format('Y-m-d'),
        'priority' => 'high'
    ];

    $response = $this->actingAs($user)->post(route('tasks.store'), $taskData);

    $response->assertRedirect(route('tasks.index'));
    $response->assertSessionHas('success', 'Tarefa criada');


    $this->assertDatabaseHas('tasks', [
        'title' => 'Minha Nova Tarefa',
        'description' => 'Descrição da tarefa',
        'priority' => 'high',
        'completed' => false,
        'user_id' => $user->id
    ]);
});

test('A validação dos dados funciona na criação de tarefas?', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('tasks.store'), [
        'description' => 'Descrição sem título',
        'priority' => 'low'
    ]);

    $response->assertSessionHasErrors(['title']);
});


test('Usuário pode ver o detalhe da tarefa?', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create([
        'title' => 'Minha Tarefa',
        'description' => 'Descrição detalhada'
    ]);

    $response = $this->actingAs($user)->get(route('tasks.show', $task));

    $response->assertOk();
    $response->assertJson([
        'id' => $task->id,
        'title' => 'Minha Tarefa',
        'description' => 'Descrição detalhada',
        'priority' => $task->priority,
        'completed' => $task->completed
    ]);
});

test('Usuário pode editar/atualizar a tarefa?', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create([
        'title' => 'Título Original',
        'description' => 'Descrição Original',
        'priority' => 'low'
    ]);

    $updateData = [
        'title' => 'Título Atualizado',
        'description' => 'Descrição Atualizada',
        'due_date' => now()->addDays(10)->format('Y-m-d'),
        'priority' => 'high'
    ];

    $response = $this->actingAs($user)->patch(route('tasks.update', $task), $updateData);

    $response->assertRedirect(route('tasks.index'));
    $response->assertSessionHas('success', 'Tarefa atualizada');

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => 'Título Atualizado',
        'description' => 'Descrição Atualizada',
        'priority' => 'high'
    ]);
});

test('Usuário pode remover/deletar a tarefa?', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create([
        'title' => 'Tarefa para Eliminar'
    ]);

    $response = $this->actingAs($user)->delete(route('tasks.destroy', $task));

    $response->assertRedirect(route('tasks.index'));
    $response->assertSessionHas('success', 'Tarefa eliminada');

    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id
    ]);
});

