<?php

namespace App\Models\master_data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = 'tahun_ajarans';
    protected $fillable = [
        'tahun_mulai',
        'tahun_selesai',
        'semester',
        'status'
    ];

    public function kelas(): HasMany
    {
        return $this->hasMany(kelas::class, 'kd_tahun_ajaran', 'id');
    }
    public function GuruPiket(): HasMany
    {
        return $this->hasMany(GuruPiket::class, 'kd_tahun_ajaran', 'id');
    }
}
