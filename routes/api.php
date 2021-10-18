<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TaskController;


// Route::get('todo-list', [TodoListController::class, 'index'])->name('todo-list.index');
// Route::get('todo-list/{todo_list}', [TodoListController::class, 'show'])->name('todo-list.show');
// Route::post('todo-list', [TodoListController::class, 'store'])->name('todo-list.store');
// Route::delete('todo-list/{todo_list}', [TodoListController::class, 'destroy'])->name('todo-list.destroy');
// Route::patch('todo-list/{todo_list}', [TodoListController::class, 'update'])->name('todo-list.update');
Route::apiResource('todo-list', TodoListController::class);

Route::apiResource('todo-list.task', TaskController::class)
->except('show')
->shallow();