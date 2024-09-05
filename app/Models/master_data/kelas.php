<?php

namespace App\Models\master_data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
        'walikelas_id'
    ];

    public function walikelas(): BelongsTo
    {
        return $this->belongsTo(Walikelas::class, 'walikelas_id', 'id');
    }
}
