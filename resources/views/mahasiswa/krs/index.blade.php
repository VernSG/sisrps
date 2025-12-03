<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kartu Rencana Studi (KRS)') }}
            </h2>
            <a href="{{ route('mahasiswa.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Info Mahasiswa -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-blue-800">
                            {{ Auth::user()->name }}
                        </h3>
                        @if(Auth::user()->mahasiswaProfile)
                            <p class="text-blue-700">NIM: {{ Auth::user()->mahasiswaProfile->npm }}</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="text-blue-600 text-sm">Mata kuliah sudah diambil: {{ count($matkulDiambil) }}</p>
                        <a href="{{ route('mahasiswa.krs.list') }}" class="text-blue-800 hover:text-blue-900 font-medium">
                            Lihat Mata Kuliah Saya →
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Pilih Mata Kuliah</h3>
                    
                    @if($matkuls->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($matkuls as $matkul)
                                <div class="border border-gray-200 rounded-lg p-6 {{ in_array($matkul->id, $matkulDiambil) ? 'bg-gray-50 opacity-60' : 'bg-white hover:shadow-md' }} transition-all">
                                    <!-- Header Mata Kuliah -->
                                    <div class="mb-4">
                                        <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $matkul->nama_matkul }}</h4>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $matkul->sks }} SKS
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Semester {{ $matkul->semester }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600">{{ $matkul->prodi }}</p>
                                        <p class="text-xs text-gray-500 mt-1">Kode: {{ $matkul->kode_matkul }}</p>
                                    </div>

                                    <!-- Status dan Action -->
                                    <div class="mt-4">
                                        @if(in_array($matkul->id, $matkulDiambil))
                                            <div class="flex items-center justify-center py-2 px-4 bg-green-100 text-green-800 rounded-lg">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Sudah Diambil
                                            </div>
                                        @else
                                            <form action="{{ route('mahasiswa.krs.store') }}" method="POST" class="inline-block w-full">
                                                @csrf
                                                <input type="hidden" name="matkul_id" value="{{ $matkul->id }}">
                                                <button type="submit" 
                                                        class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors"
                                                        onclick="return confirm('Apakah Anda yakin ingin mengambil mata kuliah ini?')">
                                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    Ambil Mata Kuliah
                                                </button>
                                            </form>
                                        @endif
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
                            <p class="text-gray-500">Belum ada mata kuliah yang tersedia untuk dipilih.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 flex justify-center space-x-4">
                <a href="{{ route('mahasiswa.krs.list') }}" 
                   class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    Lihat Mata Kuliah Saya
                </a>
            </div>
        </div>
    </div>
</x-app-layout>