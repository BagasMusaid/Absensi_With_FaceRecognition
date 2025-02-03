<?php

namespace App\Models\presensi;

use App\Models\master_data\Walikelas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Guru extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'gurus';
    protected $primaryKey = 'kd_guru';
    public $incrementing = false;
    protected $keyType = 'char';
    protected $guard = 'guru';
    protected $fillable = [
        'kd_guru',
        'NIP',
        'nama_guru',
        'jenis_kelamin',
        'agama',
        'alamat',
        'no_telp',
        'email',
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
    public function walikelas(): HasMany
    {
        return $this->hasMany(Walikelas::class, 'guru_id', 'kd_guru');
    }
}