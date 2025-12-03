<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\Rps;
use App\Models\Khs;
use Illuminate\Support\Facades\Auth;

class MahasiswaDashboardController extends Controller
{
    public function index()
    {
        $mahasiswaProfile = Auth::user()->mahasiswaProfile;
        
        // Jumlah mata kuliah yang diambil (KRS)
        $jumlahMatkul = $mahasiswaProfile->krs()->count();
        
        // Jumlah RPS tersedia berdasarkan mata kuliah yang diambil
        $matkulIds = $mahasiswaProfile->krs()->pluck('matkul_id');
        $jumlahRps = Rps::whereIn('matkul_id', $matkulIds)->count();
        
        // Jumlah nilai KHS yang sudah ada
        $jumlahNilai = $mahasiswaProfile->khs()->count();
        
        return view('mahasiswa.dashboard', compact('jumlahMatkul', 'jumlahRps', 'jumlahNilai'));
    }
}