@extends('admin.layout')

@section('title', 'View Skill')
@section('page-title', $skill->name)
@section('page-description', 'Skill details and proficiency information')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <div class="text-center mb-8">
            @if($skill->icon)
                <div class="text-6xl mb-4">{{ $skill->icon }}</div>
            @endif
            <h1 class="text-3xl font-bold text-white mb-2">{{ $skill->name }}</h1>
            <span class="px-4 py-2 bg-blue-500/20 text-blue-400 rounded-full capitalize">
                {{ str_replace('_', ' ', $skill->category) }}
            </span>
        </div>

        <div class="space-y-6">
            <div class="text-center">
                <h3 class="text-lg font-semibold text-white mb-2">Proficiency Level</h3>
                <div class="text-3xl text-yellow-400 mb-2">{{ $skill->proficiency_stars }}</div>
                <p class="text-gray-400">{{ $skill->proficiency_level }}/5 - {{ $skill->proficiency_percentage }}%</p>
            </div>

            @if($skill->description)
            <div>
                <h3 class="text-lg font-semibold text-white mb-2">Description</h3>
                <p class="text-gray-300">{{ $skill->description }}</p>
            </div>
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h4 class="font-semibold text-white mb-2">Status</h4>
                    <div class="space-y-2">
                        @if($skill->is_featured)
                            <span class="block px-3 py-1 bg-yellow-500/20 text-yellow-400 text-sm rounded w-fit">Featured</span>
                        @endif
                        @if($skill->is_active)
                            <span class="block px-3 py-1 bg-green-500/20 text-green-400 text-sm rounded w-fit">Active</span>
                        @else
                            <span class="block px-3 py-1 bg-gray-500/20 text-gray-400 text-sm rounded w-fit">Inactive</span>
                        @endif
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-2">Sort Order</h4>
                    <p class="text-gray-300">{{ $skill->sort_order }}</p>
                </div>
            </div>
        </div>

        <div class="flex justify-between mt-8 pt-6 border-t border-gray-700">
            <a href="{{ route('admin.skills.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back to Skills
            </a>
            <a href="{{ route('admin.skills.edit', $skill) }}" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors">
                <i class="fas fa-edit mr-2"></i>Edit Skill
            </a>
        </div>
    </div>
</div>
@endsection