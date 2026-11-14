<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $kode_barang
 * @property string $nama_barang
 * @property string $kategori
 * @property int $stok
 * @property string $kondisi
 * @property string|null $gambar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Item extends Model
{
    protected $guarded = ['id'];
}
