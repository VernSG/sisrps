<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DosenProfile;
use App\Models\MahasiswaProfile;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $role = Auth::user()->role->name;

        return match ($role) {
            'admin' => view('dashboard.admin', [
                'totalMahasiswa' => MahasiswaProfile::count(),
                'totalDosen' => DosenProfile::count(),
                'totalMatkul' => Matkul::count(),
                'totalUsers' => User::count()
            ]),
            'dosen' => view('dashboard.dosen', [
                'dosenProfile' => Auth::user()->dosenProfile,
                'matkuls' => Auth::user()->dosenProfile?->matkuls ?? collect()
            ]),
            'mahasiswa' => view('dashboard.mahasiswa', [
                'mahasiswaProfile' => Auth::user()->mahasiswaProfile,
                'krsList' => Auth::user()->mahasiswaProfile?->krs ?? collect()
            ]),
            default => abort(403)
        };
    }
}
