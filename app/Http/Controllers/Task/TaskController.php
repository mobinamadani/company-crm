<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssignedNotification;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasRole('admin')){

            $tasks = Task::with(['creator', 'users'])
                ->latest()
                ->paginate(10);

        }else{

            $tasks = auth()->user()
                ->tasks()
                ->with(['creator', 'users'])
                ->latest()
                ->paginate(10);

        }

        return view('task.index', compact('tasks'));
    }

    public function create()
    {
        $user = User::all();

        return view('task.create', compact('user'));
    }

    public function show(Task $task)
    {
        $task->load(['creator', 'users']);

        return view('task.show', compact('task'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'title' => 'required',
            'text' => 'nullable',
            'take_date' => 'required|date',
            'status' => 'required',
            'users' => 'required'
        ]);

        $task = Task::create([
            'created_by' => auth()->id(),
            'title' => $request->title,
            'text' => $request->text,
            'take_date' => $request->take_date,
            'status' => $request->status,
        ]);
//        dd($task);
        $task->users()->sync($request->users ?? []);

        foreach ($request->users ?? [] as $userId) {
            $user = User::find($userId);

            if ($user) {
                $user->notify(new TaskAssignedNotification($task));
            }
        }

        return redirect()
            ->route('task.index')
            ->with('success','تسک با موفقیت ثبت شد');
    }

    public function edit(Task $task)
    {
        $users = User::all();

        return view('task.edit', compact('task','users'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'nullable',
            'task_date' => 'nullable|date',
            'status' => 'required',
            'users' => 'required'
        ]);

        $task->update([
            'title' => $request->title,
            'text' => $request->text,
            'task_date'=> $request->task_date,
            'status' => $request->status,
        ]);

        $task->users()->sync($request->users ?? []);

        return redirect()
            ->route('task.index')
            ->with('success','تسک ویرایش شد');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back()->with('success','تسک حذف شد');
    }

}
