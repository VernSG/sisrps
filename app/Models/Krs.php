<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Krs extends Model
{
    protected $table = 'krs';
    
    protected $fillable = [
        'mahasiswa_id',
        'matkul_id',
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
}
