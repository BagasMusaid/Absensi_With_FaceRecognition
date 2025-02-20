<?php

namespace App\Models\presensi;

use App\Models\master_data\Kelas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'alamat',
        'wajah'
    ];
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
