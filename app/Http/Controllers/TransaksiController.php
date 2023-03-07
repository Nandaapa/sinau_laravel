<?php

namespace App\Http\Controllers;

use App\Models\Detailpeminjaman;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DetailPeminjamanModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;



class TransaksiController extends Controller
{

    public function getpinjam()
    {
        $dt_pinjam = Peminjaman::join('Siswa','Siswa.id','=','Peminjaman.id_siswa')
        ->join('Kelas','Kelas.id_kelas','=','Siswa.id_kelas')
        ->join('Buku','Buku.id_buku','=','Peminjaman.id_buku')
        ->get();
        return response()->json($dt_pinjam);
    }

    public function getpinjamid($id)
    {
        $dt_pinjam = Peminjaman::where('id_peminjaman',$id)
        ->get();
        return response()->json($dt_pinjam);
    }

    public function deletepinjam($id)
    {
        $hapus = Peminjaman::where('id_peminjaman', $id)->delete();
        if ($hapus) {
            return Response()->json(['status' => true, 'message' => 'Sukses Menghapus Siswa']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal Menghapus Siswa']);
        }   
    }
    

    public function pinjambuku(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id_siswa' => 'required',
            'id_buku' => 'required',
            'tgl_kembali' => 'required',
            'status' => "dipinjam"
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }

        $tgl_pinjam= carbon::now();

        $save = Peminjaman::create([
            'id_siswa' => $req->get('id_siswa'),
            'id_buku' => $req->get('id_buku'),
            'tgl_pinjam' => $tgl_pinjam,
            'tgl_kembali' => $req->get('tgl_kembali'),
            'status' => "dipinjam"
        ]);
        if ($save) {
            return Response()->json(['status' => 1, 'message' => 'Sukses transaksi']);
        } else {
            return Response()->json(['status' => 0, 'message' => 'Gagal']);
        }
    }


    public function getdetail()
    {
        $dt_detail = Detailpeminjaman::get();
        return response()->json($dt_detail);
    }
    

    public function detailpinjam(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id_peminjaman' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'status' => "dipinjam"
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }
        $save = Detailpeminjaman::create([
            'id_peminjaman' => $req->get('id_peminjaman'),
            'tgl_pinjam' => $req->get('tgl_pinjam'),
            'tgl_kembali' => $req->get('tgl_kembali'),
            'status' => "dipinjam"
        ]);
        if ($save) {
            return Response()->json(['status' => 1, 'message' => 'Sukses detail transaksi']);
        } else {
            return Response()->json(['status' => 0, 'message' => 'Gagal']);
        }
    }

    public function kembali($id)
    {
        
        $tgl_kembali= carbon::now()->addDays(3);


        $kembali = Peminjaman::where('id_peminjaman',$id)
        ->update(['status' => 'kembali','tgl_kembali' => $tgl_kembali]);
        if ($kembali) {
            return Response()->json(['status' => 1, 'message' => 'Terima Kasih Telah Membaca Buku' ,'buku jembtan ilmu']);
        } else {
            return Response()->json(['status' => 0, 'message' => 'Buku sudah dikembalikan']);
        }
    }
}
