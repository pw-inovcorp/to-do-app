<?php

use App\Models\User;
use App\Models\Task;


test('Dashboard mostra corretamente as métricas do usuário?', function () {
    $user = User::factory()->create();


    // 2 tarefas concluídas
    Task::factory()->count(2)->create([
        'user_id' => $user->id,
        'completed' => true
    ]);

    // 3 tarefas pendentes
    Task::factory()->count(3)->create([
        'user_id' => $user->id,
        'completed' => false,
        'due_date' => now()->addDays(5)
    ]);

    // 1 tarefa vencida
    Task::factory()->create([
        'user_id' => $user->id,
        'completed' => false,
        'due_date' => now()->subDays(2)
    ]);


    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertOk();
    $response->assertViewIs('dashboard');


    $response->assertViewHas('totalTasks', 6);      // 2 + 3 + 1 = 6
    $response->assertViewHas('finishedTasks', 2);   // 2 concluídas
    $response->assertViewHas('unfinishedTasks', 4); // 3 + 1 = 4 pendentes
    $response->assertViewHas('overdueTasks', 1);    // 1 vencida


    $response->assertSee('Total de tarefas');
    $response->assertSee('Concluídas');
    $response->assertSee('Pendentes');
    $response->assertSee('Vencidas');
});
