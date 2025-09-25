<?php

use App\Models\User;
use App\Models\Task;

test('Cada usuário só pode ver as tarefas do próprio usuário', function () {


    $user1 = User::factory()->create();
    $user2 = User::factory()->create();


    $user1Tasks = Task::factory()->count(3)->create([
        'user_id' => $user1->id,
        'title' => 'Task do User 1'
    ]);


    $user2Tasks = Task::factory()->count(2)->create([
        'user_id' => $user2->id,
        'title' => 'Task do User 2'
    ]);


    $response = $this->actingAs($user1)->get(route('tasks.index'));

    $response->assertOk();

    foreach ($user1Tasks as $task) {
        $response->assertSee($task->title);
    }

    foreach ($user2Tasks as $task) {
        $response->assertDontSee($task->title);
    }
});


test('Usuários não autenticados não podem ver as tarefas', function () {

    $task = Task::factory()->create();

    $response = $this->get(route('tasks.index'));


    $response->assertRedirect(route('login'));
});
