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
        return Inertia::render('Projects/Tasks', [
            'project' => $project,
            'tasks' => $tasks,
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

        return redirect()->route('projects.show', $project);
    }
}
