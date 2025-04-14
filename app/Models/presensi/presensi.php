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
    ];
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'nis_siswa', 'NIS');
    }
}
