<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getimage()
    {
        $dt_image =Image::get();
        return response()->json($dt_image);
    }
    public function imageupload(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $req->all();
  
        if ($image = $req->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
    
        Image::create($input);
        return Response()->json(['status' => true, 'message' => 'Sukses Tambah Image']);
    }
    }


