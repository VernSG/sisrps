<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DosenMatkul extends Model
{
    protected $table = 'dosen_matkul';
    
    protected $fillable = [
        'dosen_id',
        'matkul_id',
    ];

    public function dosenProfile(): BelongsTo
    {
        return $this->belongsTo(DosenProfile::class, 'dosen_id');
    }

    public function matkul(): BelongsTo
    {
        return $this->belongsTo(Matkul::class);
    }
}
