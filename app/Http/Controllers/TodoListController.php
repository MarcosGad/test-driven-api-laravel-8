<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\TodoListRequest;


class TodoListController extends Controller
{
    
    public function index()
    {
       //return response(['lists' => []]);
       $lists = auth()->user()->todo_lists;
       return response($lists);
    }


    public function show(TodoList $todo_list)
    {
        //$todo_list = TodoList::findOrFail($id);
        return response($todo_list);  
    }


    public function store(TodoListRequest $request)
    {
        return auth()->user()->todo_lists()->create($request->validated());
    }


    public function destroy(TodoList $todo_list)
    {
       $todo_list->delete();
       return response('', Response::HTTP_NO_CONTENT);
    }


    public function update(TodoListRequest $request, TodoList $todo_list)
    {
       return $todo_list->update($request->validated());
    }



}
