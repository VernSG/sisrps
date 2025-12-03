<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DosenProfile extends Model
{
    protected $fillable = [
        'user_id',
        'nidn',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function matkuls(): BelongsToMany
    {
        return $this->belongsToMany(Matkul::class, 'dosen_matkul', 'dosen_id', 'matkul_id');
    }

    public function rps(): HasMany
    {
        return $this->hasMany(Rps::class, 'dosen_id');
    }

    public function khs(): HasMany
    {
        return $this->hasMany(Khs::class, 'dosen_id');
    }
}
