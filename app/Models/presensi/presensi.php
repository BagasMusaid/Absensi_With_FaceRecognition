<?php

namespace App\Models\presensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class presensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nis_siswa',
        'tanggal',
        'waktu_presensi',
        'status',
        'jadwal_id'
    ];
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'nis_siswa', 'NIS');
    }
    public function JadwalPresensi(): BelongsTo
    {
        return $this->belongsTo(JadwalPresensi::class, 'jadwal_id', 'id');
    }
}
