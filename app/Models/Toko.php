<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable=[
        "nama_barang",
        "overview",
        "fotopath",
        "category_id",
    ];
    public $timestamp = true;
}
