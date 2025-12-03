<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rps extends Model
{
    protected $table = 'rps';
    
    protected $fillable = [
        'matkul_id',
        'dosen_id',
        'file_path',
        'semester',
        'tahun_ajaran',
    ];

    public function matkul(): BelongsTo
    {
        return $this->belongsTo(Matkul::class);
    }

    public function dosenProfile(): BelongsTo
    {
        return $this->belongsTo(DosenProfile::class, 'dosen_id');
    }
}
