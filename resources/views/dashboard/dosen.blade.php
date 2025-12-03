<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">
                        Selamat datang, {{ $dosenProfile?->user->name ?? 'Dosen' }}!
                    </h3>
                    
                    @if($dosenProfile)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <h4 class="font-semibold text-blue-800">Informasi Dosen</h4>
                            <p class="text-blue-700">NIDN: {{ $dosenProfile->nidn }}</p>
                        </div>
                    @endif

                    <!-- Mata Kuliah yang Diajar -->
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold mb-4">Mata Kuliah yang Anda Ajar</h4>
                        
                        @if($matkuls->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($matkuls as $matkul)
                                <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-2">
                                        <h5 class="font-semibold text-gray-800">{{ $matkul->nama_matkul }}</h5>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            {{ $matkul->sks }} SKS
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-1">Semester: {{ $matkul->semester }}</p>
                                    <p class="text-sm text-gray-600 mb-4">Prodi: {{ $matkul->prodi }}</p>
                                    
                                    <div class="flex space-x-2">
                                        <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded">
                                            RPS
                                        </a>
                                        <a href="#" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded">
                                            Input Nilai
                                        </a>
                                        <a href="#" class="bg-gray-500 hover:bg-gray-600 text-white text-xs px-3 py-1 rounded">
                                            Daftar Mahasiswa
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <h5 class="font-semibold text-yellow-800">Belum Ada Mata Kuliah</h5>
                                        <p class="text-yellow-700">Anda belum memiliki mata kuliah yang diajar. Hubungi admin untuk penugasan mata kuliah.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-semibold mb-4">Menu Utama</h4>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <a href="#" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow text-center">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800">RPS</h5>
                                <p class="text-sm text-gray-600">Kelola RPS</p>
                            </a>
                            <a href="#" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow text-center">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800">Input Nilai</h5>
                                <p class="text-sm text-gray-600">Input nilai mahasiswa</p>
                            </a>
                            <a href="#" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow text-center">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-1a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800">Mahasiswa</h5>
                                <p class="text-sm text-gray-600">Daftar mahasiswa</p>
                            </a>
                            <a href="#" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow text-center">
                                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800">Profile</h5>
                                <p class="text-sm text-gray-600">Edit profil</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>