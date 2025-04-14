<?php

namespace App\Models\pengenalan;

use App\Models\presensi\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wajah extends Model
{
    use HasFactory;

    protected $fillable = ['NIS_Siswa', 'embedding', 'face_images'];

    protected $casts = [
        'embedding' => 'array', // Konversi ke array saat diambil dari database
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'NIS_Siswa', 'NIS');
    }
}
