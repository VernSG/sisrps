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
                        Selamat datang, {{ $dosenProfile->user->name }}!
                    </h3>
                    
                    <!-- Informasi Dosen -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h4 class="font-semibold text-blue-800 mb-2">Informasi Dosen</h4>
                        <p class="text-blue-700">NIDN: {{ $dosenProfile->nidn }}</p>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <!-- Total Mata Kuliah -->
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-3xl font-bold">{{ $totalMatkul }}</h4>
                                    <p class="text-blue-100">Mata Kuliah Diajar</p>
                                </div>
                                <div class="bg-blue-400 rounded-full p-3">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Total RPS -->
                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-3xl font-bold">{{ $totalRps }}</h4>
                                    <p class="text-green-100">RPS Terupload</p>
                                </div>
                                <div class="bg-green-400 rounded-full p-3">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- RPS Progress -->
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    @php
                                        $rpsProgress = $totalMatkul > 0 ? round(($totalRps / $totalMatkul) * 100) : 0;
                                    @endphp
                                    <h4 class="text-3xl font-bold">{{ $rpsProgress }}%</h4>
                                    <p class="text-purple-100">Progress RPS</p>
                                </div>
                                <div class="bg-purple-400 rounded-full p-3">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold mb-4">Menu Utama</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <a href="{{ route('dosen.matkul.index') }}" class="bg-white border-2 border-blue-200 hover:border-blue-400 rounded-lg p-6 text-center transition-colors">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800">Mata Kuliah</h5>
                                <p class="text-sm text-gray-600">Lihat semua mata kuliah</p>
                            </a>

                            <a href="#" class="bg-white border-2 border-green-200 hover:border-green-400 rounded-lg p-6 text-center transition-colors">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800">Upload RPS</h5>
                                <p class="text-sm text-gray-600">Upload dokumen RPS</p>
                            </a>

                            <a href="#" class="bg-white border-2 border-purple-200 hover:border-purple-400 rounded-lg p-6 text-center transition-colors">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800">Input Nilai</h5>
                                <p class="text-sm text-gray-600">Input nilai mahasiswa</p>
                            </a>

                            <a href="{{ route('profile.edit') }}" class="bg-white border-2 border-orange-200 hover:border-orange-400 rounded-lg p-6 text-center transition-colors">
                                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800">Profile</h5>
                                <p class="text-sm text-gray-600">Edit profil</p>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activity / Mata Kuliah Preview -->
                    @if($matkuls->isNotEmpty())
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-lg font-semibold text-gray-800">Mata Kuliah yang Anda Ajar</h4>
                                <a href="{{ route('dosen.matkul.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    Lihat Semua →
                                </a>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($matkuls->take(6) as $matkul)
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <h5 class="font-semibold text-gray-800 mb-2">{{ $matkul->nama_matkul }}</h5>
                                        <div class="flex justify-between items-center text-sm text-gray-600 mb-2">
                                            <span>{{ $matkul->sks }} SKS</span>
                                            <span>Semester {{ $matkul->semester }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500 mb-3">{{ $matkul->prodi }}</p>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('dosen.rps.create', $matkul) }}" 
                                               class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-2 py-1 rounded">
                                                RPS
                                            </a>
                                            <a href="{{ route('dosen.nilai.index', $matkul) }}" 
                                               class="bg-green-500 hover:bg-green-600 text-white text-xs px-2 py-1 rounded">
                                                Nilai
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                            <svg class="w-12 h-12 text-yellow-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <h4 class="font-semibold text-yellow-800 mb-2">Belum Ada Mata Kuliah</h4>
                            <p class="text-yellow-700">Anda belum memiliki mata kuliah yang ditugaskan. Hubungi admin untuk penugasan mata kuliah.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>