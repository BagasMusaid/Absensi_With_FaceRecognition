<?php

namespace App\Models\presensi;

use App\Models\master_data\Kelas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalPresensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'kelas_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai'
    ];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
    public function presensi(): HasMany
    {
        return $this->hasMany(presensi::class, 'jadwal_id', 'id');
    }
}
