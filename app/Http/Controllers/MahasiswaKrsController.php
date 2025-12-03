<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;

class MahasiswaKrsController extends Controller
{
    public function index()
    {
        $mahasiswaProfile = Auth::user()->mahasiswaProfile;
        
        // Ambil semua mata kuliah yang tersedia
        $matkuls = Matkul::all();
        
        // Ambil mata kuliah yang sudah diambil mahasiswa
        $matkulDiambil = $mahasiswaProfile->krs()->pluck('matkul_id')->toArray();
        
        return view('mahasiswa.krs.index', compact('matkuls', 'matkulDiambil'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'matkul_id' => 'required|exists:matkul,id',
            'semester' => 'nullable|numeric',
            'tahun_ajaran' => 'nullable|string'
        ]);
        
        $mahasiswaProfile = Auth::user()->mahasiswaProfile;
        
        // Cek apakah mahasiswa sudah mengambil mata kuliah tersebut
        $sudahAmbil = Krs::where('mahasiswa_id', $mahasiswaProfile->id)
                         ->where('matkul_id', $request->matkul_id)
                         ->exists();
        
        abort_if($sudahAmbil, 400, 'Anda sudah mengambil mata kuliah ini');
        
        // Insert ke tabel KRS
        Krs::create([
            'mahasiswa_id' => $mahasiswaProfile->id,
            'matkul_id' => $request->matkul_id,
            'semester' => $request->semester ?? date('n') <= 6 ? 2 : 1, // Semester genap jika bulan <= 6, ganjil jika > 6
            'tahun_ajaran' => $request->tahun_ajaran ?? date('Y') . '/' . (date('Y') + 1)
        ]);
        
        return redirect()->route('mahasiswa.krs.list')->with('success', 'Mata kuliah berhasil diambil!');
    }
    
    public function list()
    {
        $mahasiswaProfile = Auth::user()->mahasiswaProfile;
        
        // Ambil daftar mata kuliah yang diambil mahasiswa
        $krsList = $mahasiswaProfile->krs()->with('matkul')->get();
        
        return view('mahasiswa.krs.list', compact('krsList'));
    }
}