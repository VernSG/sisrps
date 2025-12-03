<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mata Kuliah yang Anda Ajar') }}
            </h2>
            <a href="{{ route('dosen.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Info Dosen -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h4 class="font-semibold text-blue-800">{{ $dosenProfile->user->name }}</h4>
                        <p class="text-blue-700 text-sm">NIDN: {{ $dosenProfile->nidn }}</p>
                    </div>

                    @if($matkuls->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($matkuls as $matkul)
                                <div class="bg-white border-2 border-gray-200 hover:border-blue-300 rounded-lg p-6 transition-all">
                                    <!-- Header Mata Kuliah -->
                                    <div class="mb-4">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $matkul->nama_matkul }}</h3>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $matkul->sks }} SKS
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Semester {{ $matkul->semester }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600">{{ $matkul->prodi }}</p>
                                    </div>

                                    <!-- RPS Status -->
                                    <div class="mb-4">
                                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Status RPS:</h4>
                                        @php
                                            $rpsCount = $matkul->rps->where('dosen_id', $dosenProfile->id)->count();
                                        @endphp
                                        @if($rpsCount > 0)
                                            <div class="bg-green-50 border border-green-200 rounded p-2">
                                                <p class="text-sm text-green-800">
                                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    {{ $rpsCount }} RPS terupload
                                                </p>
                                            </div>
                                        @else
                                            <div class="bg-yellow-50 border border-yellow-200 rounded p-2">
                                                <p class="text-sm text-yellow-800">
                                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                    </svg>
                                                    Belum ada RPS
                                                </p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="space-y-2">
                                        <a href="{{ route('dosen.rps.create', $matkul) }}" 
                                           class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-center block transition-colors">
                                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                            </svg>
                                            Upload/Kelola RPS
                                        </a>
                                        
                                        <a href="{{ route('dosen.nilai.index', $matkul) }}" 
                                           class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-center block transition-colors">
                                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                            </svg>
                                            Input Nilai Mahasiswa
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Mata Kuliah</h3>
                            <p class="text-gray-500 mb-4">Anda belum memiliki mata kuliah yang ditugaskan.</p>
                            <p class="text-sm text-gray-400">Hubungi admin untuk penugasan mata kuliah.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>