<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kartu Hasil Studi (KHS)') }}
            </h2>
            <a href="{{ route('mahasiswa.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Info Mahasiswa -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-blue-800">{{ Auth::user()->name }}</h3>
                @if(Auth::user()->mahasiswaProfile)
                    <p class="text-blue-700">NIM: {{ Auth::user()->mahasiswaProfile->npm }}</p>
                @endif
                <p class="text-blue-600 mt-2">
                    <strong>Nilai Tersedia:</strong> {{ $khsList->count() }} mata kuliah
                </p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Daftar Nilai</h3>
                    
                    @if($khsList->isNotEmpty())
                        <!-- Desktop Table -->
                        <div class="hidden lg:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tugas</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">UTS</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">UAS</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Akhir</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($khsList as $index => $khs)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-900">
                                                <div>
                                                    <div class="font-medium">{{ $khs->matkul->nama_matkul }}</div>
                                                    <div class="text-gray-500 text-xs">{{ $khs->matkul->kode_matkul }} ({{ $khs->matkul->sks }} SKS)</div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-900">
                                                <div>
                                                    <div class="font-medium text-sm">{{ $khs->dosenProfile->user->name }}</div>
                                                    <div class="text-gray-500 text-xs">NIDN: {{ $khs->dosenProfile->nidn }}</div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $khs->tugas ?? '-' }}
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $khs->uts ?? '-' }}
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $khs->uas ?? '-' }}
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                {{ $khs->nilai_akhir ?? '-' }}
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                @if($khs->grade)
                                                    @php
                                                        $gradeClass = match($khs->grade) {
                                                            'A', 'A-' => 'bg-green-100 text-green-800',
                                                            'B+', 'B', 'B-' => 'bg-blue-100 text-blue-800',
                                                            'C+', 'C', 'C-' => 'bg-yellow-100 text-yellow-800',
                                                            'D' => 'bg-red-100 text-red-700',
                                                            'E' => 'bg-red-100 text-red-800',
                                                            default => 'bg-gray-100 text-gray-800'
                                                        };
                                                    @endphp
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $gradeClass }}">
                                                        {{ $khs->grade }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $khs->semester }} / {{ $khs->tahun_ajaran }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile/Tablet Cards -->
                        <div class="lg:hidden space-y-4">
                            @foreach($khsList as $index => $khs)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="flex-1">
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $khs->matkul->nama_matkul }}</h4>
                                            <p class="text-sm text-gray-600">{{ $khs->matkul->kode_matkul }} ({{ $khs->matkul->sks }} SKS)</p>
                                        </div>
                                        @if($khs->grade)
                                            @php
                                                $gradeClass = match($khs->grade) {
                                                    'A', 'A-' => 'bg-green-100 text-green-800',
                                                    'B+', 'B', 'B-' => 'bg-blue-100 text-blue-800',
                                                    'C+', 'C', 'C-' => 'bg-yellow-100 text-yellow-800',
                                                    'D' => 'bg-red-100 text-red-700',
                                                    'E' => 'bg-red-100 text-red-800',
                                                    default => 'bg-gray-100 text-gray-800'
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $gradeClass }}">
                                                {{ $khs->grade }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-3 text-sm text-gray-600 mb-3">
                                        <div>
                                            <p><span class="font-medium">Dosen:</span> {{ $khs->dosenProfile->user->name }}</p>
                                            <p><span class="font-medium">NIDN:</span> {{ $khs->dosenProfile->nidn }}</p>
                                        </div>
                                        <div>
                                            <p><span class="font-medium">Semester:</span> {{ $khs->semester }}</p>
                                            <p><span class="font-medium">Tahun:</span> {{ $khs->tahun_ajaran }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="border-t pt-3">
                                        <div class="grid grid-cols-4 gap-2 text-center">
                                            <div>
                                                <p class="text-xs font-medium text-gray-500">Tugas</p>
                                                <p class="text-sm font-semibold">{{ $khs->tugas ?? '-' }}</p>
                                            </div>
                                            <div>
                                                <p class="text-xs font-medium text-gray-500">UTS</p>
                                                <p class="text-sm font-semibold">{{ $khs->uts ?? '-' }}</p>
                                            </div>
                                            <div>
                                                <p class="text-xs font-medium text-gray-500">UAS</p>
                                                <p class="text-sm font-semibold">{{ $khs->uas ?? '-' }}</p>
                                            </div>
                                            <div>
                                                <p class="text-xs font-medium text-gray-500">Nilai Akhir</p>
                                                <p class="text-sm font-semibold text-blue-600">{{ $khs->nilai_akhir ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Summary -->
                        @php
                            $totalSks = $khsList->sum('matkul.sks');
                            $nilaiTertimbang = $khsList->filter(function($khs) {
                                return !is_null($khs->nilai_akhir);
                            });
                            $ipk = $nilaiTertimbang->isNotEmpty() ? 
                                   $nilaiTertimbang->sum(function($khs) {
                                       $nilaiAngka = match($khs->grade) {
                                           'A' => 4.0, 'A-' => 3.7,
                                           'B+' => 3.3, 'B' => 3.0, 'B-' => 2.7,
                                           'C+' => 2.3, 'C' => 2.0, 'C-' => 1.7,
                                           'D' => 1.0, 'E' => 0.0,
                                           default => 0.0
                                       };
                                       return $nilaiAngka * $khs->matkul->sks;
                                   }) / $totalSks : 0;
                        @endphp
                        
                        @if($nilaiTertimbang->isNotEmpty())
                            <div class="mt-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Akademik</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-blue-600">{{ $khsList->count() }}</p>
                                        <p class="text-sm text-gray-600">Mata Kuliah</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-green-600">{{ $totalSks }}</p>
                                        <p class="text-sm text-gray-600">Total SKS</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-purple-600">{{ number_format($ipk, 2) }}</p>
                                        <p class="text-sm text-gray-600">IPK</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @else
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Nilai</h3>
                            <p class="text-gray-500 mb-4">Nilai belum tersedia untuk mata kuliah yang Anda ambil.</p>
                            <p class="text-sm text-gray-400">Nilai akan muncul setelah dosen menginput nilai.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 flex flex-wrap justify-center gap-4">
                <a href="{{ route('mahasiswa.krs.list') }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    Mata Kuliah Saya
                </a>
                <a href="{{ route('mahasiswa.rps.index') }}" 
                   class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded-lg transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Lihat RPS
                </a>
            </div>
        </div>
    </div>
</x-app-layout>