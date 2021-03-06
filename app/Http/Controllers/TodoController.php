<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoCreateRequest;


class TodoController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth');
     }

    public function index()
    {
        $todos = Todo::orderBy('completed')->get();
        //return view('todos.index')->with(['todos' => $todos]);-longer version
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(TodoCreateRequest $request)
    {
        $userId = auth()->id();
        $request["user_id"] = $userId;
        Todo::create($request->all());
        return redirect()->back()->with('message','Todo created succesfully');
    }

    public function edit(Todo $todo)
    {
        
        return view('todos.edit', compact('todo'));
    }

    public function update(TodoCreateRequest $request, Todo $todo)
    {
        $todo->update(['title' => $request->title]);
        return redirect(route('todo.index'))->with('message', 'Updated!');
    }

    public function complete(Todo $todo)
    {
        $todo->update(['completed'=>true]);
        return redirect()->back()->with('message','Task marked as completed!');
    }

    public function incomplete(Todo $todo)
    {
        $todo->update(['completed'=>false]);
        return redirect()->back()->with('message','Task marked as incompleted!');
    }

    public function delete(Todo $todo)
    {
        $todo->delete();
        return redirect()->back()->with('message','Task deleted!');
    }

}

