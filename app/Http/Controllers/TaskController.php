<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\DeleteTaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated() + ['user_id' => 1]);
        return new TaskResource($task);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->validated());
        return new TaskResource($task);
    }

    public function destroy(DeleteTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف المهمة بنجاح',
        ], 200);
    }
}
