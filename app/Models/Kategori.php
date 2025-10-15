<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'thumbnail',
        'video'
    ];

    protected $casts = [
        'kategori' => 'string',
    ];

    public static function getKategoriOptions()
    {
        return ['adventure', 'horror', 'comedy', 'drama', 'action', 'romance'];
    }
}
