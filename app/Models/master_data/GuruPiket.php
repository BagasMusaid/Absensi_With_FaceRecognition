<?php

namespace App\Models\master_data;

use App\Models\presensi\Guru;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;


class GuruPiket extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'guru_id',
        'kd_tahun_ajaran',
        'hari',
        'password'
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->password = Hash::make($model->password);
        });
    }
    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'kd_guru');
    }
    public function tahun_ajaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'kd_tahun_ajaran', 'id');
    }
}
