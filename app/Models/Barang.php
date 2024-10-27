<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'sku',
        'satuan',
        'harga_beli',
        'jumlah_stok',
        'foto', // Menambahkan kolom foto ke dalam fillable
    ];
}
