<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request, $projectId)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:Chưa bắt đầu,Đang thực hiện,Đã hoàn thành',
        ]);

        $project = Project::findOrFail($projectId);
        $task = $project->tasks()->create($validated);

        return response()->json([
            'message' => 'Nhiệm vụ được tạo',
            'task' => $task
        ], 201);
    }
    /**
     * Display a listing of the resource.
     */
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);
        return response()->json(['tasks' => $project->tasks]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($projectId, $taskId)
    {
        $task = Task::where('project_id', $projectId)->findOrFail($taskId);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $projectId, $taskId)
    {
        $task = Task::where('project_id', $projectId)->findOrFail($taskId);
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:Chưa bắt đầu,Đang thực hiện,Đã hoàn thành',
        ]);

        $task->update($validated);
        return response()->json([
            'message' => 'Nhiệm vụ được cập nhật',
            'task' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($projectId, $taskId)
    {
        $task = Task::where('project_id', $projectId)->findOrFail($taskId);
        $task->delete();
        return response()->json(['message' => 'Nhiệm vụ được xóa']);
    }
}
