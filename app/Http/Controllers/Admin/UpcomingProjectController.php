<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpcomingProject;
use Illuminate\Http\Request;

class UpcomingProjectController extends Controller
{
    public function index()
    {
        $projects = UpcomingProject::orderBy('expected_completion')->paginate(10);
        return view('admin.upcoming-projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.upcoming-projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'required|string',
            'progress_percentage' => 'required|integer|min:0|max:100',
            'expected_completion' => 'required|date',
            'status' => 'required|in:planning,in_progress,testing,delayed',
            'current_phase' => 'nullable|string',
            'milestones' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        UpcomingProject::create($request->all());

        return redirect()->route('admin.upcoming-projects.index')->with('success', 'Upcoming project created successfully!');
    }

    public function show(UpcomingProject $upcomingProject)
    {
        return view('admin.upcoming-projects.show', compact('upcomingProject'));
    }

    public function edit(UpcomingProject $upcomingProject)
    {
        return view('admin.upcoming-projects.edit', compact('upcomingProject'));
    }

    public function update(Request $request, UpcomingProject $upcomingProject)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'required|string',
            'progress_percentage' => 'required|integer|min:0|max:100',
            'expected_completion' => 'required|date',
            'status' => 'required|in:planning,in_progress,testing,delayed',
            'current_phase' => 'nullable|string',
            'milestones' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        $upcomingProject->update($request->all());

        return redirect()->route('admin.upcoming-projects.index')->with('success', 'Upcoming project updated successfully!');
    }

    public function destroy(UpcomingProject $upcomingProject)
    {
        $upcomingProject->delete();
        return redirect()->route('admin.upcoming-projects.index')->with('success', 'Upcoming project deleted successfully!');
    }
}
