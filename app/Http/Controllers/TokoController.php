<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Toko;

class TokoController extends Controller
{
    function InsertBarang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            "overview" => 'required',
            'fotopath' => 'required|max:10000|mimes:jpg,jpeg,png',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }
        try {
            $barang = new Toko();
            $file = $request->fotopath;
            if (!$request->hasFile('fotopath')) {
            } else {
                $imageName = time() . '-' . $file->getClientOriginalName();
                $uploadDir    = public_path().'/images';
                $file->move($uploadDir, $imageName);
                $barang->fotopath = 'images/'.$imageName;
            }

            $barang->nama_barang = $request->nama_barang;
            $barang->overview = $request->overview;
            $barang->category_id = $request->category_id;

            $barang->save();
            return Response()->json([
                'status' => true,
                'message' => 'Sukses input data barang',
            ]);
        } catch (Exception $e) {
            return Response()->json(["status" => false, 'message' => $e]);
        }
    }

    function getBarang()
    {
        try {
            $barang = Toko::select('barang.*', 'category.category_name')->join('category', 'category.id', 'barang.category_id')->get();
            return response()->json([
                'status' => true,
                'message' => 'berhasil load data barang',
                'data' => $barang,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'gagal load data barang. ' . $e,
            ]);
        }
    }

    function getDetailBarang($id) {
        try{
            $barang = Toko::where('id',$id)->first();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data detail barang',
                'data'=>$barang,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data barang'. $e,
            ]);
        }
    }

    function updateBarang($id, Request $request){
        $validator = Validator::make($request->all(), [
            'nama_barang'=>'required',
            'overview'=>'required',
            'fotopath'=>'max:10000|mimes:jpg,jpeg,png',
            'category_id'=>'required',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }
        try {
            $barang = Toko::find($id);
            if($barang) {
                $file = $request->fotopath;
                if(!$request->hasFile('fotopath')) {
                } else {
                    $imageName = time().'-'.$file->getClientOriginalName();
                    $uploadDir    = public_path().'/images';
                    $file->move($uploadDir, $imageName);
                    $barang->fotopath = 'images/'.$imageName;
                }

                $barang->nama_barang = $request->nama_barang;
                $barang->overview = $request->overview;
                $barang->category_id = $request->category_id;

                $barang->save();
                return Response()->json([
                    'status'=>true,
                    'message'=>'Sukses update data barang'
                ]);
            } else {
                return Response()->json([
                    'status'=>false,
                    'message'=>'Data barang ini tidak ditemukan'
                ]);
            }
        } catch (Exception $e) {
            return Response()->json(["status"=>false, 'message'=>$e]);
        }
    }

    function hapusBarang($id) {
        try{
            Toko::where('id',$id)->delete();
            return Response()->json([
                "status"=>true,
                'message'=>'Data berhasil dihapus'
            ]);
        } catch(Exception $e){
            return Response()->json([
                'status'=>false,
                'message'=>'gagal hapus barang.' .$e,
            ]);
        }
    }
}
