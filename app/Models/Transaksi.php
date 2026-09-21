<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public function kategori()
{
    return $this->belongsTo(Kategori::class);
}

    protected $fillable = [
        'user_id',
        'kategori_id',
        'tipe',
        'jumlah',
        'catatan',
    ];
}


