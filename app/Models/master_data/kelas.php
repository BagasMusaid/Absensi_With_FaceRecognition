<?php

namespace App\Models\master_data;

use App\Models\presensi\JadwalPresensi;
use App\Models\presensi\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
        'kd_tahun_ajaran',
        'catatan'
    ];

    public function walikelas(): HasOne
    {
        return $this->hasOne(Walikelas::class, 'kelas_id', 'id');
    }
    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'kelas_id', 'id');
    }
    public function mapel(): HasMany
    {
        return $this->hasMany(mapel::class, 'kd_kelas', 'id');
    }
    public function tahun_ajaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'kd_tahun_ajaran', 'id');
    }
    public function jadwal_presensi(): HasMany
    {
        return $this->hasMany(JadwalPresensi::class, 'kelas_id', 'id');
    }
}
