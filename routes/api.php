<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LabelController;




Route::middleware('auth:sanctum')->group(function () {

    // Route::get('todo-list', [TodoListController::class, 'index'])->name('todo-list.index');
    // Route::get('todo-list/{todo_list}', [TodoListController::class, 'show'])->name('todo-list.show');
    // Route::post('todo-list', [TodoListController::class, 'store'])->name('todo-list.store');
    // Route::delete('todo-list/{todo_list}', [TodoListController::class, 'destroy'])->name('todo-list.destroy');
    // Route::patch('todo-list/{todo_list}', [TodoListController::class, 'update'])->name('todo-list.update');
    Route::apiResource('todo-list', TodoListController::class);

    Route::apiResource('todo-list.task', TaskController::class)->except('show')->shallow();

    Route::apiResource('label', LabelController::class);

});

Route::post('/register', RegisterController::class)->name('user.register');
Route::post('/login', LoginController::class)->name('user.login');

