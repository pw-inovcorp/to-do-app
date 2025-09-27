<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return redirect()->route('dashboard.index');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth',)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/db-debug', function() {
    try {
        $connection = DB::connection()->getPdo();

        $tables = DB::select('SHOW TABLES');

        $userCount = DB::table('users')->count();

        return response()->json([
            'connected' => true,
            'tables' => $tables,
            'user_count' => $userCount
        ]);
    } catch (Exception $e) {
        return response()->json([
            'error' => $e->getMessage()
        ]);
    }
});

Route::middleware('auth', 'verified')->group(function () {

    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');


});

require __DIR__.'/auth.php';
