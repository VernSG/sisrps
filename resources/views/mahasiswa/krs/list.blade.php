<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mata Kuliah Saya') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('mahasiswa.krs.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Ambil Mata Kuliah
                </a>
                <a href="{{ route('mahasiswa.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Info Mahasiswa -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-blue-800">{{ Auth::user()->name }}</h3>
                @if(Auth::user()->mahasiswaProfile)
                    <p class="text-blue-700">NIM: {{ Auth::user()->mahasiswaProfile->nim }}</p>
                @endif
                <p class="text-blue-600 mt-2">
                    <strong>Total Mata Kuliah:</strong> {{ $krsList->count() }} mata kuliah
                    @if($krsList->count() > 0)
                        | <strong>Total SKS:</strong> {{ $krsList->sum('matkul.sks') }} SKS
                    @endif
                </p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Daftar Mata Kuliah yang Diambil</h3>
                    
                    @if($krsList->isNotEmpty())
                        <!-- Desktop Table -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mata Kuliah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Ajaran</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program Studi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($krsList as $index => $krs)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $krs->matkul->kode_matkul }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $krs->matkul->nama_matkul }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $krs->matkul->sks }} SKS
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $krs->semester }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $krs->tahun_ajaran }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $krs->matkul->prodi }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="md:hidden space-y-4">
                            @foreach($krsList as $index => $krs)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="text-lg font-semibold text-gray-800">{{ $krs->matkul->nama_matkul }}</h4>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $krs->matkul->sks }} SKS
                                        </span>
                                    </div>
                                    <div class="space-y-1 text-sm text-gray-600">
                                        <p><span class="font-medium">Kode:</span> {{ $krs->matkul->kode_matkul }}</p>
                                        <p><span class="font-medium">Semester:</span> {{ $krs->semester }}</p>
                                        <p><span class="font-medium">Tahun Ajaran:</span> {{ $krs->tahun_ajaran }}</p>
                                        <p><span class="font-medium">Program Studi:</span> {{ $krs->matkul->prodi }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Summary -->
                        <div class="mt-6 bg-gray-50 rounded-lg p-4">
                            <div class="flex flex-wrap justify-between items-center text-sm text-gray-700">
                                <span><strong>Total Mata Kuliah:</strong> {{ $krsList->count() }}</span>
                                <span><strong>Total SKS:</strong> {{ $krsList->sum('matkul.sks') }}</span>
                            </div>
                        </div>

                    @else
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Mata Kuliah</h3>
                            <p class="text-gray-500 mb-4">Anda belum mengambil mata kuliah apapun untuk semester ini.</p>
                            <a href="{{ route('mahasiswa.krs.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Ambil Mata Kuliah
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            @if($krsList->isNotEmpty())
                <div class="mt-6 flex flex-wrap justify-center gap-4">
                    <a href="{{ route('mahasiswa.rps.index') }}" 
                       class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded-lg transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Lihat RPS
                    </a>
                    <a href="{{ route('mahasiswa.khs.index') }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        Lihat Nilai
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>