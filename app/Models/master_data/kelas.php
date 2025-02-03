<?php

namespace App\Models\master_data;

use App\Models\presensi\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
        'tahun_ajaran',
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
}
