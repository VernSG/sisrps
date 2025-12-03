<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Input Nilai - ') . $matkul->nama_matkul }}
            </h2>
            <a href="{{ route('dosen.matkul.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Kembali ke Mata Kuliah
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Info Mata Kuliah -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                <div class="flex flex-wrap justify-between items-start">
                    <div>
                        <h3 class="text-xl font-semibold text-blue-800 mb-2">{{ $matkul->nama_matkul }}</h3>
                        <p class="text-blue-700 mb-1">{{ $matkul->sks }} SKS - Semester {{ $matkul->semester }}</p>
                        <p class="text-blue-600">Program Studi: {{ $matkul->prodi }}</p>
                        <p class="text-blue-600 mt-2">
                            <strong>Total Mahasiswa:</strong> {{ $students->count() }} orang
                        </p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        {{ $matkul->kode_matkul }}
                    </span>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
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

                    @if($students->isNotEmpty())
                        <!-- Filter dan Info -->
                        <div class="flex flex-wrap justify-between items-center mb-6">
                            <div class="flex items-center space-x-4">
                                <h4 class="text-lg font-semibold text-gray-800">Daftar Mahasiswa</h4>
                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-sm">
                                    {{ $students->count() }} mahasiswa
                                </span>
                            </div>
                        </div>

                        <!-- Form Input Nilai -->
                        <form action="{{ route('dosen.nilai.store', $matkul) }}" method="POST" id="nilaiForm">
                            @csrf
                            
                            <!-- Tabel Nilai -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NPM</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tugas (30%)</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">UTS (35%)</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">UAS (35%)</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Akhir</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($students as $index => $student)
                                            @php
                                                $nilai_tugas = $student->existing_nilai['tugas'] ?? '';
                                                $nilai_uts = $student->existing_nilai['uts'] ?? '';
                                                $nilai_uas = $student->existing_nilai['uas'] ?? '';
                                                $nilai_akhir = $student->existing_nilai['nilai_akhir'] ?? '';
                                                $grade = $student->existing_nilai['grade'] ?? '';
                                            @endphp
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $student->mahasiswa->npm ?? 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $student->mahasiswa->user->name ?? 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="hidden" name="mahasiswa[{{ $student->mahasiswa->id }}][mahasiswa_id]" value="{{ $student->mahasiswa->id }}">
                                                    <input type="number" 
                                                           name="mahasiswa[{{ $student->mahasiswa->id }}][tugas]" 
                                                           value="{{ old('mahasiswa.'.$student->mahasiswa->id.'.tugas', $nilai_tugas) }}"
                                                           min="0" max="100" step="0.1"
                                                           class="tugas-input w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                           data-mahasiswa="{{ $student->mahasiswa->id }}">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="number" 
                                                           name="mahasiswa[{{ $student->mahasiswa->id }}][uts]" 
                                                           value="{{ old('mahasiswa.'.$student->mahasiswa->id.'.uts', $nilai_uts) }}"
                                                           min="0" max="100" step="0.1"
                                                           class="uts-input w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                           data-mahasiswa="{{ $student->mahasiswa->id }}">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="number" 
                                                           name="mahasiswa[{{ $student->mahasiswa->id }}][uas]" 
                                                           value="{{ old('mahasiswa.'.$student->mahasiswa->id.'.uas', $nilai_uas) }}"
                                                           min="0" max="100" step="0.1"
                                                           class="uas-input w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                           data-mahasiswa="{{ $student->mahasiswa->id }}">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="nilai-akhir text-sm font-medium" id="nilai-akhir-{{ $student->mahasiswa->id }}">
                                                        {{ $nilai_akhir ?: '-' }}
                                                    </span>
                                                    <input type="hidden" name="mahasiswa[{{ $student->mahasiswa->id }}][nilai_akhir]" 
                                                           id="input-nilai-akhir-{{ $student->mahasiswa->id }}" value="{{ $nilai_akhir }}">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="grade-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                          id="grade-{{ $student->mahasiswa->id }}">
                                                        {{ $grade ?: '-' }}
                                                    </span>
                                                    <input type="hidden" name="mahasiswa[{{ $student->mahasiswa->id }}][grade]" 
                                                           id="input-grade-{{ $student->mahasiswa->id }}" value="{{ $grade }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-8 flex justify-end space-x-4">
                                <button type="button" id="hitungSemua" 
                                        class="px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    Hitung Semua Nilai
                                </button>
                                <button type="submit" 
                                        class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Semua Nilai
                                </button>
                            </div>
                        </form>

                    @else
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Mahasiswa</h3>
                            <p class="text-gray-500 mb-4">Belum ada mahasiswa yang mengambil mata kuliah ini.</p>
                            <p class="text-sm text-gray-400">Mahasiswa perlu melakukan KRS terlebih dahulu.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menghitung nilai akhir dan grade
        function hitungNilaiAkhir(mahasiswaId) {
            const tugasInput = document.querySelector(`input[name="mahasiswa[${mahasiswaId}][tugas]"]`);
            const utsInput = document.querySelector(`input[name="mahasiswa[${mahasiswaId}][uts]"]`);
            const uasInput = document.querySelector(`input[name="mahasiswa[${mahasiswaId}][uas]"]`);
            
            const tugas = parseFloat(tugasInput.value) || 0;
            const uts = parseFloat(utsInput.value) || 0;
            const uas = parseFloat(uasInput.value) || 0;
            
            // Hitung nilai akhir dengan bobot: Tugas 30%, UTS 35%, UAS 35%
            const nilaiAkhir = (tugas * 0.3) + (uts * 0.35) + (uas * 0.35);
            const nilaiAkhirRounded = Math.round(nilaiAkhir * 100) / 100;
            
            // Tentukan grade
            let grade = '';
            let gradeClass = '';
            
            if (nilaiAkhirRounded >= 85) {
                grade = 'A';
                gradeClass = 'bg-green-100 text-green-800';
            } else if (nilaiAkhirRounded >= 80) {
                grade = 'A-';
                gradeClass = 'bg-green-100 text-green-700';
            } else if (nilaiAkhirRounded >= 75) {
                grade = 'B+';
                gradeClass = 'bg-blue-100 text-blue-800';
            } else if (nilaiAkhirRounded >= 70) {
                grade = 'B';
                gradeClass = 'bg-blue-100 text-blue-700';
            } else if (nilaiAkhirRounded >= 65) {
                grade = 'B-';
                gradeClass = 'bg-blue-100 text-blue-600';
            } else if (nilaiAkhirRounded >= 60) {
                grade = 'C+';
                gradeClass = 'bg-yellow-100 text-yellow-800';
            } else if (nilaiAkhirRounded >= 55) {
                grade = 'C';
                gradeClass = 'bg-yellow-100 text-yellow-700';
            } else if (nilaiAkhirRounded >= 50) {
                grade = 'C-';
                gradeClass = 'bg-yellow-100 text-yellow-600';
            } else if (nilaiAkhirRounded >= 40) {
                grade = 'D';
                gradeClass = 'bg-red-100 text-red-700';
            } else {
                grade = 'E';
                gradeClass = 'bg-red-100 text-red-800';
            }
            
            // Update tampilan
            document.getElementById(`nilai-akhir-${mahasiswaId}`).textContent = nilaiAkhirRounded;
            document.getElementById(`input-nilai-akhir-${mahasiswaId}`).value = nilaiAkhirRounded;
            
            const gradeElement = document.getElementById(`grade-${mahasiswaId}`);
            gradeElement.textContent = grade;
            gradeElement.className = `grade-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${gradeClass}`;
            document.getElementById(`input-grade-${mahasiswaId}`).value = grade;
        }
        
        // Event listener untuk setiap input nilai
        document.querySelectorAll('.tugas-input, .uts-input, .uas-input').forEach(input => {
            input.addEventListener('input', function() {
                const mahasiswaId = this.dataset.mahasiswa;
                hitungNilaiAkhir(mahasiswaId);
            });
        });
        
        // Button hitung semua nilai
        document.getElementById('hitungSemua').addEventListener('click', function() {
            const allMahasiswa = document.querySelectorAll('.tugas-input');
            allMahasiswa.forEach(input => {
                const mahasiswaId = input.dataset.mahasiswa;
                hitungNilaiAkhir(mahasiswaId);
            });
        });
        
        // Hitung nilai yang sudah ada saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const allMahasiswa = document.querySelectorAll('.tugas-input');
            allMahasiswa.forEach(input => {
                const mahasiswaId = input.dataset.mahasiswa;
                const tugasValue = input.value;
                const utsValue = document.querySelector(`input[name="mahasiswa[${mahasiswaId}][uts]"]`).value;
                const uasValue = document.querySelector(`input[name="mahasiswa[${mahasiswaId}][uas]"]`).value;
                
                if (tugasValue || utsValue || uasValue) {
                    hitungNilaiAkhir(mahasiswaId);
                }
            });
        });
    </script>
</x-app-layout>