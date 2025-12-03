<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matkul extends Model
{
    protected $table = 'matkul';
    
    protected $fillable = [
        'nama_matkul',
        'sks',
        'semester',
        'prodi',
    ];

    public function dosenProfiles(): BelongsToMany
    {
        return $this->belongsToMany(DosenProfile::class, 'dosen_matkul', 'matkul_id', 'dosen_id');
    }

    public function krs(): HasMany
    {
        return $this->hasMany(Krs::class);
    }

    public function rps(): HasMany
    {
        return $this->hasMany(Rps::class);
    }

    public function khs(): HasMany
    {
        return $this->hasMany(Khs::class);
    }
}
