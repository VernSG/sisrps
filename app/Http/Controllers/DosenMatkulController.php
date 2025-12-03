<?php

namespace App\Http\Controllers;

use App\Models\DosenProfile;
use App\Models\Matkul;
use App\Models\DosenMatkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DosenMatkulController extends Controller
{
    /**
     * Display the assignment form for a specific dosen
     */
    public function show(DosenProfile $dosen)
    {
        $dosen->load(['user', 'matkuls']);
        $allMatkuls = Matkul::all();
        $assignedMatkulIds = $dosen->matkuls->pluck('id')->toArray();
        
        return view('admin.dosen-matkul.show', compact('dosen', 'allMatkuls', 'assignedMatkulIds'));
    }

    /**
     * Update dosen mata kuliah assignments
     */
    public function update(Request $request, DosenProfile $dosen)
    {
        $request->validate([
            'matkul_ids' => 'nullable|array',
            'matkul_ids.*' => 'exists:matkul,id'
        ]);

        DB::transaction(function () use ($request, $dosen) {
            // Delete existing assignments
            DosenMatkul::where('dosen_id', $dosen->id)->delete();

            // Create new assignments
            if ($request->has('matkul_ids')) {
                foreach ($request->matkul_ids as $matkulId) {
                    DosenMatkul::create([
                        'dosen_id' => $dosen->id,
                        'matkul_id' => $matkulId,
                    ]);
                }
            }
        });

        return redirect()->route('admin.dosen-matkul.show', $dosen)
            ->with('success', 'Assignment mata kuliah berhasil diupdate.');
    }

    /**
     * Display list of all dosen for assignment management (Admin)
     */
    public function index()
    {
        // Check if this is admin accessing or dosen accessing
        if (request()->is('admin/*')) {
            $dosens = DosenProfile::with(['user', 'matkuls'])->paginate(10);
            return view('admin.dosen-matkul.index', compact('dosens'));
        }
        
        // Dosen accessing their own mata kuliah
        return $this->dosenIndex();
    }
    
    /**
     * Display mata kuliah list for authenticated dosen
     */
    public function dosenIndex()
    {
        $dosenProfile = Auth::user()->dosenProfile;
        $matkuls = $dosenProfile->matkuls()->with('rps')->get();
        
        return view('dosen.matkul.index', compact('matkuls', 'dosenProfile'));
    }
}
