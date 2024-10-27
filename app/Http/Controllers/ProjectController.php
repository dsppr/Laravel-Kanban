<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectStatus;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        // Mengambil semua project dengan status
        $projects = Project::with('status')->get(['id', 'name', 'description', 'start_date', 'due_date', 'status_id']);
        return Inertia::render('Projects/Index', [
            'projects' => $projects,
        ]);
    }

    public function create()
    {
        $statuses = ProjectStatus::all();
        return inertia('Projects/Create', ['statuses' => $statuses]);
    }


    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:project_statuses,id',
            'start_date' => 'required|date', // Validasi untuk tanggal mulai
            'due_date' => 'required|date|after_or_equal:start_date', // Validasi tanggal selesai
        ]);

        // Membuat project baru dengan data yang diterima
        Project::create($request->all());

        // Redirect ke halaman project index
        return redirect()->route('projects.index');
    }

    public function edit(Project $project)
    {
        $statuses = ProjectStatus::all();
        return Inertia::render('Projects/Edit', [
            'project' => $project,
            'statuses' => $statuses,
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:project_statuses,id',
            'start_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:start_date',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }

    public function show($id)
    {
        $project = Project::with('tasks')->findOrFail($id);

        return Inertia::render('Projects/Show', [
            'project' => $project,
        ]);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }
}
