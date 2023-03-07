<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class BukuController extends Controller
{
    public function getbuku()
    {
        $dt_buku = Buku::get();
        return response()->json($dt_buku);
    }

    public function jumlahbuku()
    {
        $dt_buku = Buku::count();
        return response()->json($dt_buku);
    }

    public function getbukuid($id)
    {
        $dt_buku = Buku::where('id_buku',$id)->
        get();
        return response()->json($dt_buku);
    }

    public function createbuku(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'judul' => 'required',
            'pengarang' => 'required'
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }
        $save = Buku::create([
            'judul' => $req->get('judul'),
            'pengarang' => $req->get('pengarang')
        ]);
        if ($save) {
            return Response()->json(['status' => true, 'message' => 'Sukses Menambah buku']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal Menambah buku']);
        }
    }

    public function updatebuku(Request $req, $id_buku)
    {
        $validator = Validator::make($req->all(), [
            'judul' => 'required'
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }
        $update = Buku::where('id_buku', $id_buku)->update([
            'judul' => $req->get('judul')
        ]);

        if ($update) {
            return Response()->json(['status' => true, 'message' => 'Sukses Mengubah buku']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal Mengubah buku']);
        }
    }
    public function deletebuku($id_buku)
    {
        $hapus = Buku::where('id_buku', $id_buku)->delete();
        if ($hapus) {
            return Response()->json(['status' => true, 'message' => 'Sukses Menghapus buku']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal Menghapus buku']);
        }   
    }
}
