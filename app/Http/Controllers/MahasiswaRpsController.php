<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rps;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    
    /**
     * Download RPS file for mahasiswa
     */
    public function download(Rps $rps)
    {
        $mahasiswaProfile = Auth::user()->mahasiswaProfile;
        
        // Check if mahasiswa has taken the mata kuliah (KRS)
        $hasKrs = Krs::where('mahasiswa_id', $mahasiswaProfile->id)
                    ->where('matkul_id', $rps->matkul_id)
                    ->exists();
        
        abort_if(!$hasKrs, 403, 'Anda tidak memiliki akses ke RPS ini. Silakan ambil mata kuliah terlebih dahulu.');
        
        // Check if file exists
        if (!Storage::disk('local')->exists($rps->file_path)) {
            abort(404, 'File RPS tidak ditemukan.');
        }
        
        // Download file
        return Storage::disk('local')->download(
            $rps->file_path,
            $rps->matkul->nama_matkul . '_RPS.pdf'
        );
    }
}