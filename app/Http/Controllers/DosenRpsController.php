<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use App\Models\Rps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DosenRpsController extends Controller
{
    /**
     * Show the form for uploading RPS for a specific mata kuliah.
     */
    public function create(Matkul $matkul)
    {
        $dosenProfile = Auth::user()->dosenProfile;
        
        // Check if this matkul belongs to the authenticated dosen
        abort_if(!$dosenProfile->matkuls->contains($matkul->id), 403, 'Anda tidak memiliki akses ke mata kuliah ini.');
        
        // Get existing RPS if any
        $existingRps = Rps::where('matkul_id', $matkul->id)
                         ->where('dosen_id', $dosenProfile->id)
                         ->get();
        
        return view('dosen.rps.create', compact('matkul', 'dosenProfile', 'existingRps'));
    }
    
    /**
     * Store the uploaded RPS file.
     */
    public function store(Request $request, Matkul $matkul)
    {
        $dosenProfile = Auth::user()->dosenProfile;
        
        // Check if this matkul belongs to the authenticated dosen
        abort_if(!$dosenProfile->matkuls->contains($matkul->id), 403, 'Anda tidak memiliki akses ke mata kuliah ini.');
        
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048', // 2MB max
            'semester' => 'required|integer|min:1|max:8',
            'tahun_ajaran' => 'required|string|max:9', // Format: 2024/2025
        ]);
        
        // Create directory if not exists
        if (!Storage::disk('local')->exists('rps')) {
            Storage::disk('local')->makeDirectory('rps');
        }
        
        // Store file
        $file = $request->file('file');
        $fileName = time() . '_' . $matkul->id . '_' . $dosenProfile->id . '.pdf';
        $path = $file->storeAs('rps', $fileName, 'local');
        
        // Save RPS record
        Rps::create([
            'matkul_id' => $matkul->id,
            'dosen_id' => $dosenProfile->id,
            'file_path' => $path,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);
        
        return redirect()->route('dosen.matkul.index')
            ->with('success', 'RPS berhasil diupload untuk mata kuliah ' . $matkul->nama_matkul);
    }
    
    /**
     * Download RPS file
     */
    public function download(Rps $rps)
    {
        $dosenProfile = Auth::user()->dosenProfile;
        
        // Check if this RPS belongs to the authenticated dosen
        abort_if($rps->dosen_id !== $dosenProfile->id, 403, 'Anda tidak memiliki akses ke RPS ini.');
        
        if (!Storage::disk('local')->exists($rps->file_path)) {
            return redirect()->back()->with('error', 'File RPS tidak ditemukan.');
        }
        
        return response()->download(storage_path('app/' . $rps->file_path));
    }
}
