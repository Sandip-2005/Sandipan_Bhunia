@extends('admin.layout')

@section('title', 'Skills')
@section('page-title', 'Skills')
@section('page-description', 'Manage your technical skills and proficiency levels')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h3 class="text-xl font-semibold text-white">All Skills</h3>
        <p class="text-gray-400">{{ $skills->total() }} total skills</p>
    </div>
    <a href="{{ route('admin.skills.create') }}" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
        <i class="fas fa-plus mr-2"></i>
        Add Skill
    </a>
</div>

<div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
    @if($skills->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Skill</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Proficiency</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($skills as $skill)
                    <tr class="hover:bg-gray-700/50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 bg-gray-600 rounded-lg flex items-center justify-center">
                                    @if($skill->icon)
                                        <span class="text-2xl">{{ $skill->icon }}</span>
                                    @else
                                        <i class="fas fa-cog text-gray-400"></i>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-white">{{ $skill->name }}</div>
                                    @if($skill->description)
                                        <div class="text-sm text-gray-400">{{ Str::limit($skill->description, 50) }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-500/20 text-blue-400 text-sm rounded-full capitalize">
                                {{ str_replace('_', ' ', $skill->category) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="text-yellow-400 mr-2">{{ $skill->proficiency_stars }}</div>
                                <span class="text-sm text-gray-400">({{ $skill->proficiency_level }}/5)</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col space-y-1">
                                @if($skill->is_featured)
                                    <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 text-xs rounded w-fit">Featured</span>
                                @endif
                                @if($skill->is_active)
                                    <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs rounded w-fit">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-500/20 text-gray-400 text-xs rounded w-fit">Inactive</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.skills.show', $skill) }}" class="text-blue-400 hover:text-blue-300">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.skills.edit', $skill) }}" class="text-yellow-400 hover:text-yellow-300">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteSkill({{ $skill->id }})" class="text-red-400 hover:text-red-300">
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
        @if($skills->hasPages())
        <div class="px-6 py-4 border-t border-gray-700">
            {{ $skills->links() }}
        </div>
        @endif
    @else
        <div class="text-center py-12">
            <i class="fas fa-cogs text-6xl text-gray-600 mb-4"></i>
            <h3 class="text-lg font-medium text-white mb-2">No skills yet</h3>
            <p class="text-gray-400 mb-6">Start by adding your first technical skill.</p>
            <a href="{{ route('admin.skills.create') }}" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Add First Skill
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
function deleteSkill(id) {
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
            form.action = `/secret-gateway/skills/${id}`;
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