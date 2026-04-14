@extends('admin.layout')

@section('title', 'View QA Achievement')
@section('page-title', $qaAchievement->title)
@section('page-description', 'QA achievement details and impact information')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <div class="text-4xl mr-4">{{ $qaAchievement->tool_icon }}</div>
                <div>
                    <h1 class="text-2xl font-bold text-white mb-2">{{ $qaAchievement->title }}</h1>
                    <span class="px-3 py-1 text-sm rounded {{ $qaAchievement->achievement_type_color }}">
                        {{ ucfirst(str_replace('_', ' ', $qaAchievement->achievement_type)) }}
                    </span>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.qa-achievements.edit', $qaAchievement) }}" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('admin.qa-achievements.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Description</h3>
                <p class="text-gray-300 mb-6">{{ $qaAchievement->description }}</p>

                @if($qaAchievement->impact)
                <h3 class="text-lg font-semibold text-white mb-4">Impact</h3>
                <div class="p-4 bg-green-500/10 border border-green-500/20 rounded-lg mb-6">
                    <p class="text-green-300">{{ $qaAchievement->impact }}</p>
                </div>
                @endif

                @if($qaAchievement->evidence_link)
                <h3 class="text-lg font-semibold text-white mb-4">Evidence</h3>
                <a href="{{ $qaAchievement->evidence_link }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    View Evidence
                </a>
                @endif
            </div>

            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Achievement Details</h3>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Tool Used:</span>
                        <span class="text-white font-medium">{{ $qaAchievement->tool_used }}</span>
                    </div>
                    
                    @if($qaAchievement->bugs_found > 0)
                    <div class="flex justify-between">
                        <span class="text-gray-400">Bugs Found:</span>
                        <span class="text-red-400 font-medium">{{ $qaAchievement->bugs_found }}</span>
                    </div>
                    @endif

                    @if($qaAchievement->project_name)
                    <div class="flex justify-between">
                        <span class="text-gray-400">Project:</span>
                        <span class="text-white font-medium">{{ $qaAchievement->project_name }}</span>
                    </div>
                    @endif

                    <div class="flex justify-between">
                        <span class="text-gray-400">Achievement Date:</span>
                        <span class="text-white font-medium">{{ $qaAchievement->achievement_date->format('M d, Y') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Sort Order:</span>
                        <span class="text-white">{{ $qaAchievement->sort_order }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Status:</span>
                        <div class="space-y-1">
                            @if($qaAchievement->is_featured)
                                <span class="block px-2 py-1 bg-yellow-500/20 text-yellow-400 text-xs rounded w-fit">Featured</span>
                            @endif
                            @if($qaAchievement->is_active)
                                <span class="block px-2 py-1 bg-green-500/20 text-green-400 text-xs rounded w-fit">Active</span>
                            @else
                                <span class="block px-2 py-1 bg-gray-500/20 text-gray-400 text-xs rounded w-fit">Inactive</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Created:</span>
                        <span class="text-white">{{ $qaAchievement->created_at->format('M d, Y') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Updated:</span>
                        <span class="text-white">{{ $qaAchievement->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection