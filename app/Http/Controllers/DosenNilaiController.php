<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use App\Models\Krs;
use App\Models\Khs;
use App\Models\MahasiswaProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DosenNilaiController extends Controller
{
    /**
     * Display the grade input form for students taking the mata kuliah.
     */
    public function index(Matkul $matkul)
    {
        $dosenProfile = Auth::user()->dosenProfile;
        
        // Check if this matkul belongs to the authenticated dosen
        abort_if(!$dosenProfile->matkuls->contains($matkul->id), 403, 'Anda tidak memiliki akses ke mata kuliah ini.');
        
        // Get students who are taking this mata kuliah (from KRS)
        $students = Krs::where('matkul_id', $matkul->id)
                       ->with(['mahasiswaProfile.user'])
                       ->get()
                       ->map(function ($krs) use ($matkul, $dosenProfile) {
                           // Get existing grade if any
                           $existingKhs = Khs::where('mahasiswa_id', $krs->mahasiswa_id)
                                            ->where('matkul_id', $matkul->id)
                                            ->where('dosen_id', $dosenProfile->id)
                                            ->first();
                           
                           return (object) [
                               'krs' => $krs,
                               'mahasiswa' => $krs->mahasiswaProfile,
                               'existing_nilai' => $existingKhs ? [
                                   'tugas' => $existingKhs->tugas,
                                   'uts' => $existingKhs->uts,
                                   'uas' => $existingKhs->uas,
                                   'nilai_akhir' => $existingKhs->nilai_akhir,
                                   'grade' => $existingKhs->grade,
                               ] : null,
                               'semester' => $krs->semester,
                               'tahun_ajaran' => $krs->tahun_ajaran
                           ];
                       });
        
        return view('dosen.nilai.index', compact('matkul', 'students', 'dosenProfile'));
    }
    
    /**
     * Store or update student grades.
     */
    public function store(Request $request, Matkul $matkul)
    {
        $dosenProfile = Auth::user()->dosenProfile;
        
        // Check if this matkul belongs to the authenticated dosen
        abort_if(!$dosenProfile->matkuls->contains($matkul->id), 403, 'Anda tidak memiliki akses ke mata kuliah ini.');
        
        $request->validate([
            'mahasiswa' => 'required|array',
            'mahasiswa.*.mahasiswa_id' => 'required|exists:mahasiswa_profiles,id',
            'mahasiswa.*.tugas' => 'nullable|numeric|min:0|max:100',
            'mahasiswa.*.uts' => 'nullable|numeric|min:0|max:100',
            'mahasiswa.*.uas' => 'nullable|numeric|min:0|max:100',
            'mahasiswa.*.nilai_akhir' => 'nullable|numeric|min:0|max:100',
            'mahasiswa.*.grade' => 'nullable|string|max:2',
        ]);
        
        DB::transaction(function () use ($request, $matkul, $dosenProfile) {
            foreach ($request->mahasiswa as $mahasiswaId => $nilaiData) {
                // Skip if no nilai data provided
                if (empty($nilaiData['tugas']) && empty($nilaiData['uts']) && empty($nilaiData['uas'])) {
                    continue;
                }
                
                // Get KRS data for semester and tahun_ajaran
                $krs = Krs::where('mahasiswa_id', $nilaiData['mahasiswa_id'])
                          ->where('matkul_id', $matkul->id)
                          ->first();
                
                if (!$krs) {
                    continue; // Skip if KRS not found
                }
                
                // Update or create KHS record
                Khs::updateOrCreate(
                    [
                        'mahasiswa_id' => $nilaiData['mahasiswa_id'],
                        'matkul_id' => $matkul->id,
                        'dosen_id' => $dosenProfile->id,
                    ],
                    [
                        'tugas' => $nilaiData['tugas'] ?? null,
                        'uts' => $nilaiData['uts'] ?? null,
                        'uas' => $nilaiData['uas'] ?? null,
                        'nilai_akhir' => $nilaiData['nilai_akhir'] ?? null,
                        'grade' => $nilaiData['grade'] ?? null,
                        'nilai' => $nilaiData['nilai_akhir'] ?? null, // For backward compatibility
                        'semester' => $krs->semester,
                        'tahun_ajaran' => $krs->tahun_ajaran,
                    ]
                );
            }
        });
        
        return redirect()->route('dosen.nilai.index', $matkul)
            ->with('success', 'Nilai berhasil disimpan untuk mata kuliah ' . $matkul->nama_matkul);
    }
}
