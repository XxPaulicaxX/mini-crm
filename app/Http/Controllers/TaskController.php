<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request){
        $query = auth()->user()->tasks()->latest();

        if($request->filled('status')) {
            $query->where('status',$request->status); 
        }

        $tasks = $query->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        auth()->user()->tasks()->create($request->all());

        return redirect()-> route('tasks.index')->with('succes', 'Task creat cu succes!');
    }

    public function edit(Task $task) {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task) {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('succes', 'Task actualizat!');
    }

    public function destroy(Task $task){
        $task -> delete();
        return redirect()->route('tasks.index')->with('succes', 'Task stars!');
    }

}
