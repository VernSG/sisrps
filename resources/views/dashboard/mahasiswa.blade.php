<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">
                        Selamat datang, {{ $mahasiswaProfile?->user->name ?? 'Mahasiswa' }}!
                    </h3>
                    
                    @if($mahasiswaProfile)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <h4 class="font-semibold text-blue-800">Informasi Mahasiswa</h4>
                            <div class="mt-2 space-y-1">
                                <p class="text-blue-700">NPM: {{ $mahasiswaProfile->npm }}</p>
                                <p class="text-blue-700">Program Studi: {{ $mahasiswaProfile->prodi }}</p>
                                <p class="text-blue-700">Angkatan: {{ $mahasiswaProfile->angkatan }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Mata Kuliah dari KRS -->
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold mb-4">Mata Kuliah yang Diambil (KRS)</h4>
                        
                        @if($krsList->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Ajaran</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($krsList as $krs)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $krs->matkul->nama_matkul }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $krs->matkul->prodi }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $krs->matkul->sks }} SKS
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $krs->semester }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $krs->tahun_ajaran }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs mr-2">
                                                    Lihat RPS
                                                </a>
                                                <a href="#" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">
                                                    Jadwal
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <h5 class="font-semibold text-yellow-800">Belum Ada KRS</h5>
                                        <p class="text-yellow-700">Anda belum mengambil mata kuliah untuk semester ini. Silakan buat KRS terlebih dahulu.</p>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800">KRS</h5>
                                <p class="text-sm text-gray-600">Kartu Rencana Studi</p>
                            </a>
                            <a href="#" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow text-center">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800">KHS</h5>
                                <p class="text-sm text-gray-600">Kartu Hasil Studi</p>
                            </a>
                            <a href="#" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow text-center">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800">Jadwal</h5>
                                <p class="text-sm text-gray-600">Jadwal kuliah</p>
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

                    <!-- Academic Progress -->
                    <div class="mt-8 bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 rounded-lg p-6">
                        <h4 class="text-lg font-semibold mb-3 text-gray-800">Progress Akademik</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600">{{ $krsList->sum(function($krs) { return $krs->matkul->sks; }) }}</div>
                                <div class="text-sm text-gray-600">Total SKS Diambil</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">-</div>
                                <div class="text-sm text-gray-600">IPK</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600">{{ $krsList->count() }}</div>
                                <div class="text-sm text-gray-600">Mata Kuliah Aktif</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>