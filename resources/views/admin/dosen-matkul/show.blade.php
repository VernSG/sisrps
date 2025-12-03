<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Assign Mata Kuliah: ') . $dosen->user->name }}
            </h2>
            <a href="{{ route('admin.dosen-matkul.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Dosen Information -->
                    <div class="mb-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-blue-800 mb-2">Informasi Dosen</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-1">Nama</label>
                                <p class="text-blue-900">{{ $dosen->user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-1">Email</label>
                                <p class="text-blue-900">{{ $dosen->user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 mb-1">NIDN</label>
                                <p class="text-blue-900">{{ $dosen->nidn }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Assignment Form -->
                    <form action="{{ route('admin.dosen-matkul.update', $dosen) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pilih Mata Kuliah yang Diajar</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($allMatkuls as $matkul)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                        <label class="flex items-start space-x-3 cursor-pointer">
                                            <input type="checkbox" 
                                                   name="matkul_ids[]" 
                                                   value="{{ $matkul->id }}"
                                                   {{ in_array($matkul->id, $assignedMatkulIds) ? 'checked' : '' }}
                                                   class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <div class="flex-1">
                                                <div class="font-semibold text-gray-800">{{ $matkul->nama_matkul }}</div>
                                                <div class="text-sm text-gray-600">
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                                                        {{ $matkul->sks }} SKS
                                                    </span>
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Semester {{ $matkul->semester }}
                                                    </span>
                                                </div>
                                                <div class="text-sm text-gray-500 mt-1">{{ $matkul->prodi }}</div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            @if($allMatkuls->isEmpty())
                                <div class="text-center text-gray-500 py-8">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    <p>Belum ada mata kuliah yang tersedia.</p>
                                    <p class="text-sm">Silakan tambahkan mata kuliah terlebih dahulu.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Bulk Actions -->
                        @if(!$allMatkuls->isEmpty())
                            <div class="mb-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-800 mb-2">Aksi Cepat</h4>
                                <div class="space-x-2">
                                    <button type="button" onclick="selectAll()" 
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                        Pilih Semua
                                    </button>
                                    <button type="button" onclick="deselectAll()" 
                                            class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm">
                                        Hapus Pilihan
                                    </button>
                                </div>
                            </div>
                        @endif

                        <!-- Current Assignments Summary -->
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                            <h4 class="font-semibold text-green-800 mb-2">Assignment Saat Ini</h4>
                            @if($assignedMatkulIds)
                                <p class="text-green-700">Terpilih: <span id="selectedCount">{{ count($assignedMatkulIds) }}</span> mata kuliah</p>
                            @else
                                <p class="text-green-700">Terpilih: <span id="selectedCount">0</span> mata kuliah</p>
                            @endif
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.dosen-matkul.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
                                Simpan Assignment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectAll() {
            const checkboxes = document.querySelectorAll('input[name="matkul_ids[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updateSelectedCount();
        }

        function deselectAll() {
            const checkboxes = document.querySelectorAll('input[name="matkul_ids[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateSelectedCount();
        }

        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('input[name="matkul_ids[]"]:checked');
            document.getElementById('selectedCount').textContent = checkboxes.length;
        }

        // Update count when checkboxes change
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[name="matkul_ids[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedCount);
            });
        });
    </script>
</x-app-layout>