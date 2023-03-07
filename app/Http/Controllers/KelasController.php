<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class KelasController extends Controller
{
    public function getkelas()
    {
        $dt_kelas = Kelas::get();
        return response()->json($dt_kelas);
    }


    public function createkelas(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama_kelas' => 'required'
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }
        $save = Kelas::create([
            'nama_kelas' => $req->get('nama_kelas')
        ]);
        if ($save) {
            return Response()->json(['status' => true, 'message' => 'Sukses Menambah kelas']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal Menambah kelas']);
        }
    }

    public function updatekelas(Request $req, $id_kelas)
    {
        $validator = Validator::make($req->all(), [
            'nama_kelas' => 'required'
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }
        $update = Kelas::where('id_kelas', $id_kelas)->update([
            'nama_kelas' => $req->get('nama_kelas')
        ]);

        if ($update) {
            return Response()->json(['status' => true, 'message' => 'Sukses Mengubah kelas']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal Mengubah kelas']);
        }
    }
    public function deletekelas($id_kelas)
    {
        $hapus = Kelas::where('id_kelas', $id_kelas)->delete();
        if ($hapus) {
            return Response()->json(['status' => true, 'message' => 'Sukses Menghapus Kelas']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal Menghapus Kelas']);
        }   
    }
}

