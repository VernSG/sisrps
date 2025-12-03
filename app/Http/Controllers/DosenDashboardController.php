<?php

namespace App\Http\Controllers;

use App\Models\Rps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenDashboardController extends Controller
{
    /**
     * Display the dosen dashboard with summary statistics.
     */
    public function index()
    {
        $dosenProfile = Auth::user()->dosenProfile;
        
        // Get mata kuliah yang diajar
        $matkuls = $dosenProfile->matkuls;
        
        // Get RPS yang sudah diupload
        $rpsCount = Rps::where('dosen_id', $dosenProfile->id)->count();
        
        return view('dosen.dashboard', [
            'totalMatkul' => $matkuls->count(),
            'totalRps' => $rpsCount,
            'dosenProfile' => $dosenProfile,
            'matkuls' => $matkuls
        ]);
    }
}
