<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primarykey = 'id_peminjaman';
    public $timestamps = false;
    protected $fillable = ['id_siswa','id_kelas','id_buku','tgl_pinjam','tgl_kembali','status'];
}
