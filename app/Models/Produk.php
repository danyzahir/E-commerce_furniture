<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',   // tambahkan ini
        'nama_produk',
        'kuantitas',
        'harga',
        'gambar',
    ];

    /**
     * Relasi ke tabel categories (setiap produk punya satu kategori)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
