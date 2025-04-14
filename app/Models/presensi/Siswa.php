<?php

namespace App\Models\presensi;

use App\Models\master_data\Kelas;
use App\Models\pengenalan\Wajah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas';
    protected $primaryKey = 'kd_siswa';
    public $incrementing = false;
    protected $keyType = 'char';
    protected $fillable = [
        'kd_siswa',
        'kelas_id',
        'NIS',
        'nama_siswa',
        'jenis_kelamin',
        'agama',
        'alamat'

    ];
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
    public function wajah(): HasMany
    {

        return $this->hasMany(Wajah::class, 'NIS_Siswa', 'NIS');
    }
    public function presensi(): HasMany
    {
        return $this->hasMany(Presensi::class, 'nis_siswa', 'NIS');
    }
}
