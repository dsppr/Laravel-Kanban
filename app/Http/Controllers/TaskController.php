<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $tasks = $project->tasks()->with('status')->get();
        $taskStatuses = TaskStatus::all()->pluck('name');

        return Inertia::render('Projects/Tasks', [
            'project' => $project,
            'tasks' => $tasks,
            'taskStatuses' => $taskStatuses,
        ]);
    }

    public function create(Project $project)
    {
        $statuses = TaskStatus::all();
        return Inertia::render('Tasks/Create', [
            'project' => $project,
            'statuses' => $statuses,
        ]);
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:task_statuses,id',
        ]);

        $project->tasks()->create($request->all());

        return redirect()->route('projects.show', $project)->with('success', 'Task created successfully.');
    }

    public function edit(Project $project, Task $task)
    {
        $statuses = TaskStatus::all();
        return Inertia::render('Tasks/Edit', [
            'project' => $project,
            'task' => $task,
            'statuses' => $statuses,
        ]);
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:task_statuses,id',
        ]);

        $task->update($request->all());

        return redirect()->route('projects.show', $project)->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->route('projects.show', $project)->with('success', 'Task deleted successfully.');
    }
    public function show($projectId, $taskId)
    {
        $task = Task::where('project_id', $projectId)->findOrFail($taskId);
        return Inertia::render('Tasks/Show', [
            'task' => $task,
            'projectId' => $projectId,
        ]);
    }
}
