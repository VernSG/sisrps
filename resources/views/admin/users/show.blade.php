<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail User: ') . $user->name }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Edit
                </a>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Basic User Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                            Informasi Dasar
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                                <p class="text-gray-900">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                                <p class="text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Role</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    @if($user->role->name === 'admin') bg-red-100 text-red-800
                                    @elseif($user->role->name === 'dosen') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($user->role->name) }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Dibuat</label>
                                <p class="text-gray-900">{{ $user->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Role Specific Information -->
                    @if($user->role->name === 'mahasiswa' && $user->mahasiswaProfile)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                                Informasi Mahasiswa
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">NPM</label>
                                    <p class="text-gray-900">{{ $user->mahasiswaProfile->npm }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Program Studi</label>
                                    <p class="text-gray-900">{{ $user->mahasiswaProfile->prodi }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Angkatan</label>
                                    <p class="text-gray-900">{{ $user->mahasiswaProfile->angkatan }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($user->role->name === 'dosen' && $user->dosenProfile)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                                Informasi Dosen
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">NIDN</label>
                                    <p class="text-gray-900">{{ $user->dosenProfile->nidn }}</p>
                                </div>
                            </div>

                            <!-- Mata Kuliah yang Diajar -->
                            <div class="mt-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="text-md font-semibold text-gray-800">Mata Kuliah yang Diajar</h4>
                                    <a href="{{ route('admin.dosen-matkul.show', $user->dosenProfile) }}" 
                                       class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                        Kelola Assignment
                                    </a>
                                </div>
                                @if($user->dosenProfile->matkuls->count() > 0)
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach($user->dosenProfile->matkuls as $matkul)
                                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                                <h5 class="font-semibold text-gray-800">{{ $matkul->nama_matkul }}</h5>
                                                <p class="text-sm text-gray-600">{{ $matkul->sks }} SKS - Semester {{ $matkul->semester }}</p>
                                                <p class="text-sm text-gray-600">{{ $matkul->prodi }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 text-sm">Belum ada mata kuliah yang ditugaskan.</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.users.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                            Kembali ke Daftar
                        </a>
                        <a href="{{ route('admin.users.edit', $user) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
                            Edit User
                        </a>
                        @if($user->role->name === 'dosen' && $user->dosenProfile)
                            <a href="{{ route('admin.dosen-matkul.show', $user->dosenProfile) }}" 
                               class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">
                                Assign Mata Kuliah
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>