<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaKhsController extends Controller
{
    public function index()
    {
        $mahasiswaProfile = Auth::user()->mahasiswaProfile;
        
        // Ambil nilai berdasarkan mahasiswa_id
        $khsList = $mahasiswaProfile->khs()
            ->with(['matkul', 'dosenProfile.user'])
            ->get();
        
        return view('mahasiswa.khs.index', compact('khsList'));
    }
}