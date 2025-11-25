<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultipleUpload extends Model
{
    protected $table = 'multipleuploads';
    protected $fillable = [
        'filename',
        'ref_table',
        'ref_id'
    ];

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'ref_id', 'pelanggan_id')
                    ->where('ref_table', 'pelanggan');
    }
}
