<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QaAchievement;
use Illuminate\Http\Request;

class QaAchievementController extends Controller
{
    public function index()
    {
        $achievements = QaAchievement::orderBy('achievement_date', 'desc')->paginate(10);
        return view('admin.qa-achievements.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.qa-achievements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tool_used' => 'required|string|max:255',
            'achievement_type' => 'required|in:bug_found,automation_created,performance_improved',
            'bugs_found' => 'nullable|integer|min:0',
            'project_name' => 'nullable|string|max:255',
            'achievement_date' => 'required|date',
            'impact' => 'nullable|string',
            'evidence_link' => 'nullable|url',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        QaAchievement::create($request->all());

        return redirect()->route('admin.qa-achievements.index')->with('success', 'QA Achievement created successfully!');
    }

    public function show(QaAchievement $qaAchievement)
    {
        return view('admin.qa-achievements.show', compact('qaAchievement'));
    }

    public function edit(QaAchievement $qaAchievement)
    {
        return view('admin.qa-achievements.edit', compact('qaAchievement'));
    }

    public function update(Request $request, QaAchievement $qaAchievement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tool_used' => 'required|string|max:255',
            'achievement_type' => 'required|in:bug_found,automation_created,performance_improved',
            'bugs_found' => 'nullable|integer|min:0',
            'project_name' => 'nullable|string|max:255',
            'achievement_date' => 'required|date',
            'impact' => 'nullable|string',
            'evidence_link' => 'nullable|url',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $qaAchievement->update($request->all());

        return redirect()->route('admin.qa-achievements.index')->with('success', 'QA Achievement updated successfully!');
    }

    public function destroy(QaAchievement $qaAchievement)
    {
        $qaAchievement->delete();
        return redirect()->route('admin.qa-achievements.index')->with('success', 'QA Achievement deleted successfully!');
    }
}
