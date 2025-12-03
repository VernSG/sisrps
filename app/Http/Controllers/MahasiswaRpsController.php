<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rps;
use Illuminate\Support\Facades\Auth;

class MahasiswaRpsController extends Controller
{
    public function index()
    {
        $mahasiswaProfile = Auth::user()->mahasiswaProfile;
        
        // Ambil semua RPS berdasarkan mata kuliah yang diambil mahasiswa
        $rpsList = Rps::select('rps.*')
            ->join('krs', 'krs.matkul_id', '=', 'rps.matkul_id')
            ->where('krs.mahasiswa_id', $mahasiswaProfile->id)
            ->with(['matkul', 'dosenProfile.user'])
            ->get();
        
        return view('mahasiswa.rps.index', compact('rpsList'));
    }
}