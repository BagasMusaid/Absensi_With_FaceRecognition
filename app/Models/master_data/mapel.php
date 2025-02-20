<?php

namespace App\Models\master_data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'mapels';
    protected $primaryKey = 'kd_mapel';
    public $incrementing = false;
    protected $keyType = 'char';
    protected $fillable = [
        'kd_mapel',
        'nama_mapel',
        'kd_kelas',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(kelas::class, 'kd_kelas', 'id');
    }
}
