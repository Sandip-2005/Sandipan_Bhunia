@extends('admin.layout')

@section('title', 'CV Management')
@section('page-title', 'CV Management')
@section('page-description', 'Manage your multiple CVs/Resumes and their public visibility')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div></div>
    <button type="button" onclick="openCreateModal()" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-lg hover:from-blue-600 hover:to-purple-600 transition-all font-medium text-sm flex items-center shadow-lg shadow-blue-500/30">
        <i class="fas fa-plus mr-2"></i> Add New CV
    </button>
</div>

<div class="glass-effect rounded-xl overflow-hidden animate-fade-in border border-white/10">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white/5 border-b border-white/10">
                    <th class="p-4 text-sm font-semibold text-gray-300">Label</th>
                    <th class="p-4 text-sm font-semibold text-gray-300">File Details</th>
                    <th class="p-4 text-sm font-semibold text-gray-300">Visibility</th>
                    <th class="p-4 text-sm font-semibold text-gray-300">Order</th>
                    <th class="p-4 text-sm font-semibold text-gray-300 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($cvs as $cv)
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="p-4">
                        <div class="font-medium text-white">{{ $cv->label }}</div>
                        <div class="text-xs text-gray-400 mt-1">Uploaded: {{ $cv->created_at->format('M d, Y') }}</div>
                    </td>
                    <td class="p-4">
                        <div class="flex items-center">
                            @if($cv->extension == 'pdf')
                                <i class="fas fa-file-pdf text-red-500 text-xl mr-3"></i>
                            @elseif(in_array($cv->extension, ['doc', 'docx']))
                                <i class="fas fa-file-word text-blue-500 text-xl mr-3"></i>
                            @else
                                <i class="fas fa-file-alt text-gray-500 text-xl mr-3"></i>
                            @endif
                            <div>
                                <div class="text-sm text-gray-300 truncate max-w-[200px]" title="{{ $cv->original_name }}">
                                    {{ $cv->original_name }}
                                </div>
                                <div class="text-xs text-gray-500">{{ number_format($cv->file_size / 1024, 2) }} KB</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        @if($cv->is_public)
                            <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs rounded-full border border-green-500/30 flex items-center w-max">
                                <i class="fas fa-globe mr-1"></i> Public
                            </span>
                        @else
                            <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 text-xs rounded-full border border-yellow-500/30 flex items-center w-max">
                                <i class="fas fa-lock mr-1"></i> Private
                            </span>
                        @endif
                    </td>
                    <td class="p-4">
                        <span class="px-2 py-1 bg-white/10 text-gray-300 text-xs rounded-lg border border-white/10">
                            {{ $cv->sort_order }}
                        </span>
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ $cv->download_url }}" target="_blank" class="w-8 h-8 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center hover:bg-blue-500/40 transition-colors" title="Download">
                                <i class="fas fa-download"></i>
                            </a>
                            <button onclick="openEditModal({{ $cv->id }}, '{{ addslashes($cv->label) }}', {{ $cv->is_public ? 'true' : 'false' }}, {{ $cv->sort_order }})" class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center hover:bg-emerald-500/40 transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.cvs.destroy', $cv->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this CV?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-red-500/20 text-red-400 flex items-center justify-center hover:bg-red-500/40 transition-colors" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-400">
                        <div class="mb-3"><i class="fas fa-file-pdf text-4xl text-gray-600"></i></div>
                        <p>No CVs found. Add one to get started.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Create/Edit -->
<div id="cvModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 opacity-0 transition-opacity duration-300">
    <div class="bg-[#1a1438] border border-white/10 rounded-2xl w-full max-w-lg shadow-2xl transform scale-95 transition-transform duration-300" id="cvModalContent">
        <div class="flex justify-between items-center p-5 border-b border-white/10">
            <h3 class="text-xl font-bold text-white flex items-center" id="modalTitle">
                <i class="fas fa-file-pdf text-purple-400 mr-2"></i>
                <span>Add New CV</span>
            </h3>
            <button onclick="closeCvModal()" class="text-gray-400 hover:text-white transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form id="cvForm" action="{{ route('admin.cvs.store') }}" method="POST" enctype="multipart/form-data" class="p-5 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">CV Label / Title <span class="text-red-400">*</span></label>
                <input type="text" name="label" id="cvLabel" required class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500" placeholder="e.g. Full Stack Developer Resume">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">File <span id="fileRequiredStar" class="text-red-400">*</span></label>
                <input type="file" name="cv_file" id="cvFile" accept=".pdf,.doc,.docx" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500 text-gray-400 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-purple-500/20 file:text-purple-300 hover:file:bg-purple-500/30">
                <p class="text-xs text-gray-500 mt-1" id="fileHelpText">PDF, DOC, DOCX up to 5MB.</p>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Sort Order</label>
                    <input type="number" name="sort_order" id="cvSortOrder" value="0" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Visibility</label>
                    <div class="flex items-center h-[38px] px-3 bg-white/5 border border-white/10 rounded-lg">
                        <label class="flex items-center cursor-pointer w-full">
                            <input type="checkbox" name="is_public" id="cvIsPublic" value="1" class="sr-only peer" checked>
                            <div class="w-9 h-5 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-green-500 relative"></div>
                            <span class="ml-3 text-sm font-medium text-gray-300" id="visibilityLabel">Public</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="pt-4 border-t border-white/10 flex justify-end gap-3">
                <button type="button" onclick="closeCvModal()" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-all text-sm font-medium">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white rounded-lg transition-all font-medium text-sm flex items-center shadow-lg shadow-purple-500/30">
                    <i class="fas fa-save mr-2"></i> Save CV
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('cvModal');
    const modalContent = document.getElementById('cvModalContent');
    const form = document.getElementById('cvForm');
    const modalTitle = document.querySelector('#modalTitle span');
    const methodInput = document.getElementById('formMethod');
    const fileInput = document.getElementById('cvFile');
    const fileRequiredStar = document.getElementById('fileRequiredStar');
    const fileHelpText = document.getElementById('fileHelpText');
    const toggleInput = document.getElementById('cvIsPublic');
    const visibilityLabel = document.getElementById('visibilityLabel');

    toggleInput.addEventListener('change', function() {
        visibilityLabel.textContent = this.checked ? 'Public' : 'Private';
        visibilityLabel.className = this.checked ? 'ml-3 text-sm font-medium text-green-400' : 'ml-3 text-sm font-medium text-yellow-400';
    });

    function openCreateModal() {
        form.action = "{{ route('admin.cvs.store') }}";
        methodInput.value = 'POST';
        modalTitle.textContent = 'Add New CV';
        form.reset();
        
        fileInput.required = true;
        fileRequiredStar.style.display = 'inline';
        fileHelpText.textContent = 'PDF, DOC, DOCX up to 5MB.';
        
        toggleInput.checked = true;
        toggleInput.dispatchEvent(new Event('change'));

        showModal();
    }

    function openEditModal(id, label, isPublic, sortOrder) {
        form.action = `/secret-gateway/cvs/${id}`;
        methodInput.value = 'PUT';
        modalTitle.textContent = 'Edit CV';
        
        document.getElementById('cvLabel').value = label;
        document.getElementById('cvSortOrder').value = sortOrder;
        
        toggleInput.checked = isPublic;
        toggleInput.dispatchEvent(new Event('change'));
        
        fileInput.required = false;
        fileRequiredStar.style.display = 'none';
        fileHelpText.textContent = 'Leave empty to keep existing file. PDF, DOC, DOCX up to 5MB.';

        showModal();
    }

    function showModal() {
        modal.classList.remove('hidden');
        // trigger animation
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
        }, 10);
    }

    function closeCvModal() {
        modal.classList.add('opacity-0');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endsection
