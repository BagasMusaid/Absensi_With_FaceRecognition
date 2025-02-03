<?php

namespace App\Models\master_data;

use App\Models\presensi\Guru;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Walikelas extends Authenticatable
{
    use HasFactory;
    protected $table = 'walikelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'guru_id',
        'kelas_id',
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
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(kelas::class, 'kelas_id', 'id');
    }
}
