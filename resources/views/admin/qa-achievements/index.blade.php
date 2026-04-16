@extends('admin.layout')

@section('title', 'Achievements')
@section('page-title', 'Achievements')
@section('page-description', 'Manage your achievements, certifications, awards, and milestones')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h3 class="text-xl font-semibold text-white">All Achievements</h3>
        <p class="text-gray-400">{{ $achievements->total() }} total achievements</p>
    </div>
    <a href="{{ route('admin.qa-achievements.create') }}" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
        <i class="fas fa-plus mr-2"></i>
        Add Achievement
    </a>
</div>

<div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
    @if($achievements->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Achievement</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tool</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Impact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($achievements as $achievement)
                    <tr class="hover:bg-gray-700/50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 bg-gray-600 rounded-lg flex items-center justify-center">
                                    <span class="text-2xl">{{ $achievement->tool_icon }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-white">{{ $achievement->title }}</div>
                                    <div class="text-sm text-gray-400">{{ Str::limit($achievement->description, 50) }}</div>
                                    @if($achievement->project_name)
                                        <div class="text-xs text-blue-400">{{ $achievement->project_name }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded {{ $achievement->achievement_type_color }}">
                                {{ ucfirst(str_replace('_', ' ', $achievement->achievement_type)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-white">{{ $achievement->tool_used }}</div>
                            @if($achievement->bugs_found > 0)
                                <div class="text-xs text-red-400">{{ $achievement->bugs_found }} bugs found</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($achievement->impact)
                                <div class="text-sm text-gray-300">{{ Str::limit($achievement->impact, 40) }}</div>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400">
                            {{ $achievement->achievement_date->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.qa-achievements.show', $achievement) }}" class="text-blue-400 hover:text-blue-300">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.qa-achievements.edit', $achievement) }}" class="text-yellow-400 hover:text-yellow-300">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteAchievement({{ $achievement->id }})" class="text-red-400 hover:text-red-300">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($achievements->hasPages())
        <div class="px-6 py-4 border-t border-gray-700">
            {{ $achievements->links() }}
        </div>
        @endif
    @else
        <div class="text-center py-12">
            <i class="fas fa-bug text-6xl text-gray-600 mb-4"></i>
            <h3 class="text-lg font-medium text-white mb-2">No QA achievements yet</h3>
            <p class="text-gray-400 mb-6">Start by adding your first testing achievement or bug discovery.</p>
            <a href="{{ route('admin.qa-achievements.create') }}" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Add First Achievement
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
function deleteAchievement(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        background: '#1f2937',
        color: '#ffffff'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/secret-gateway/qa-achievements/${id}`;
            form.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endpush
@endsection