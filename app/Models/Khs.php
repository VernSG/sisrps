<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Khs extends Model
{
    protected $table = 'khs';
    
    protected $fillable = [
        'mahasiswa_id',
        'matkul_id',
        'dosen_id',
        'nilai',
        'tugas',
        'uts',
        'uas',
        'nilai_akhir',
        'grade',
        'semester',
        'tahun_ajaran',
    ];

    public function mahasiswaProfile(): BelongsTo
    {
        return $this->belongsTo(MahasiswaProfile::class, 'mahasiswa_id');
    }

    public function matkul(): BelongsTo
    {
        return $this->belongsTo(Matkul::class);
    }

    public function dosenProfile(): BelongsTo
    {
        return $this->belongsTo(DosenProfile::class, 'dosen_id');
    }
}
