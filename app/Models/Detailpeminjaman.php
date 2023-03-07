<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpeminjaman extends Model
{
    use HasFactory;
    protected $table = 'detail_peminjaman';
    protected $primarykey = 'id_detail';
    public $timestamps = false;
    protected $fillable = ['id_peminjaman','tgl_pinjam','tgl_kembali','status'];
}
