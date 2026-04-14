@extends('admin.layout')

@section('title', 'In the Lab')
@section('page-title', 'In the Lab')
@section('page-description', 'Manage your upcoming projects and work in progress')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h3 class="text-xl font-semibold text-white">Projects in Development</h3>
        <p class="text-gray-400">{{ $projects->total() }} total projects</p>
    </div>
    <a href="{{ route('admin.upcoming-projects.create') }}" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
        <i class="fas fa-plus mr-2"></i>
        Add to Lab
    </a>
</div>

<div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
    @if($projects->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Progress</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Expected</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($projects as $project)
                    <tr class="hover:bg-gray-700/50">
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-medium text-white">{{ $project->title }}</div>
                                <div class="text-sm text-gray-400">{{ Str::limit($project->description, 60) }}</div>
                                @if($project->current_phase)
                                    <div class="text-xs text-blue-400 mt-1">{{ $project->current_phase }}</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded {{ $project->status_badge }}">
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-full bg-gray-600 rounded-full h-2 mr-3">
                                    <div class="bg-{{ $project->progress_color }}-500 h-2 rounded-full" 
                                         style="width: {{ $project->progress_percentage }}%"></div>
                                </div>
                                <span class="text-sm text-gray-300 min-w-0">{{ $project->progress_percentage }}%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400">
                            {{ $project->expected_completion->format('M Y') }}
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.upcoming-projects.show', $project) }}" class="text-blue-400 hover:text-blue-300">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.upcoming-projects.edit', $project) }}" class="text-yellow-400 hover:text-yellow-300">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteProject({{ $project->id }})" class="text-red-400 hover:text-red-300">
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
        @if($projects->hasPages())
        <div class="px-6 py-4 border-t border-gray-700">
            {{ $projects->links() }}
        </div>
        @endif
    @else
        <div class="text-center py-12">
            <i class="fas fa-flask text-6xl text-gray-600 mb-4"></i>
            <h3 class="text-lg font-medium text-white mb-2">No projects in the lab</h3>
            <p class="text-gray-400 mb-6">Start by adding your first work-in-progress project.</p>
            <a href="{{ route('admin.upcoming-projects.create') }}" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Add First Project
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
function deleteProject(id) {
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
            form.action = `/secret-gateway/upcoming-projects/${id}`;
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