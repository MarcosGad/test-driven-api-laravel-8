<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\TaskRequest;


class TaskController extends Controller
{
    public function index(TodoList $todo_list)
    {
        //$tasks = Task::where(['todo_list_id' => $todo_list->id])->get();
        $tasks = $todo_list->tasks;
        return response($tasks);
    }

    public function store(TaskRequest $request, TodoList $todo_list)
    {
       //$request['todo_list_id'] = $todo_list->id;
       //return Task::create($request->all());
       return $todo_list->tasks()->create($request->validated());
       
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function update(Request $request, Task $task)
    {
       return $task->update($request->all());
    }
}
