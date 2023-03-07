<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function getsiswa()
    {
        $dt_siswa = Siswa::join('Kelas','Kelas.id_kelas','=','Siswa.id_kelas')
        ->select('id','nama_siswa','nama_kelas')
        ->get();
        return response()->json($dt_siswa);
    }

    public function getsiswaid($id)
    {
        $dt_siswa = Siswa::where('id',$id)->
        join('Kelas','Kelas.id_kelas','=','Siswa.id_kelas')
        ->get();
        return response()->json($dt_siswa);
    }

    public function jumlahsiswa()
    {
        $dt_siswa = Siswa::count();
        return response()->json($dt_siswa);
    }
    

    public function createsiswa(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama_siswa' => 'required',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'id_kelas' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }
        $save = Siswa::create([
            'nama_siswa' => $req->get('nama_siswa'),
            'tanggal_lahir' => $req->get('tanggal_lahir'),
            'gender' => $req->get('gender'),
            'alamat' => $req->get('alamat'),
            'id_kelas' => $req->get('id_kelas')
        ]);
        if ($save) {
            return Response()->json(['status' => true, 'message' => 'Sukses Menambah Siswa']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal Menambah Siswa']);
        }
    }

    public function updatesiswa(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'nama_siswa' => 'required',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'id_kelas' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors()->toJson());
        }
        $update = Siswa::where('id', $id)->update([
            'nama_siswa' => $req->get('nama_siswa'),
            'tanggal_lahir' => $req->get('tanggal_lahir'),
            'gender' => $req->get('gender'),
            'alamat' => $req->get('alamat'),
            'id_kelas' => $req->get('id_kelas')
        ]);

        if ($update) {
            return Response()->json(['status' => true, 'message' => 'Sukses Mengubah Siswa']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal Mengubah Siswa']);
        }

    }
    
    public function deletesiswa($id)
    {
        $hapus = Siswa::where('id', $id)->delete();
        if ($hapus) {
            return Response()->json(['status' => true, 'message' => 'Sukses Menghapus Siswa']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal Menghapus Siswa']);
        }   
    }
}
