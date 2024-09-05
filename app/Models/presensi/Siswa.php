<?php

namespace App\Models\presensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas';
    protected $primaryKey = 'kd_siswa';
    public $incrementing = false;
    protected $keyType = 'char';
    protected $fillable = [
        'kd_siswa',
        'NIS',
        'nama_siswa',
        'jenis_kelamin',
        'agama',
        'alamat',
        'wajah'
    ];
}
