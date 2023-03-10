<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = "buku";
    protected $fillable = [
        'judul',
        'kode_buku',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'deskripsi',
        'gambar'];
}
