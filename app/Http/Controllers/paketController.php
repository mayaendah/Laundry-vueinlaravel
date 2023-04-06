<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paket;
use App\Models\outlet;
use Illuminate\Support\Facades\File;

class paketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->middleware('auth:api');
    }

    public function simpanPaket(Request $request){

        $imagePath=$request->file('gbr_paket')->store('image','public');

        $request->validate([
            'id_outlet'=>'required',
            'nama_paket'=>'required',
            'gbr_paket'=>'required',
            'harga_paket'=>'required'
        ]);

        $data=paket::create([
            'id_outlet'=>$request->id_outlet,
            'nama_paket'=>$request->nama_paket,
            'gbr_paket'=>$imagePath,
            'harga_paket'=>$request->harga_paket,
        ]);
        if($data){
            return response()->json([
                'pesan'=>'susscess',
                'data'=>$data
            ]);
        }

    }

    public function getPaket(){
        $data=paket::join('outlets','pakets.id_outlet','=','outlets.id')->get(['outlets.*','pakets.*']);
        if($data){
            return response()->json([
                'pesan'=>'susscess',
                'data'=>$data
            ]);
        }
    }

    public function hapusPaket($id){


        $data=paket::find($id);

        $destination=public_path("storage\\".$data->gbr_paket);
        if(File::exists($destination)){
            File::delete($destination);
        }

        if($data){
            $data->delete();
            return response()->json([
                'pesan'=>'data berhasil di hapus',
                'code'=>200
            ]);
        }else{
            return response()->json([
                'pesan'=>'data dengan id:$id tidak tersedia',
                'code'=>400
            ]);
        }
    }

    public function UbahPaket($id){
        $data=paket::where('id',$id)->first();
        if($data){
            return response([
                'pesan'=>'Success',
                'data'=>$data
            ],200);
        }

    }

    public function updatePaket(Request $request){
        // $request->validate([
        //     'id_paket'=>'required',
        //     'id_outlet'=>'required',
        //     'nama_paket'=>'required',
        //     'gbr_paket'=>'required',
        //     'harga_paket'=>'required'
        // ]);

        $dataById=paket::where('id',$request->id_paket)->first();

        $destination=public_path("storage\\".$dataById->gbr_paket);
        $fileImage="";
        if($request->hasFile('newImage')){
            if(File::exists($destination)){
                File::delete( $destination);
            }
            $fileImage=$request->file('newImage')->store('image','public');
        }else{
            $fileImage=$request->gbr_paket;
        }

        $dataById->id_outlet=$request->id_outlet;
        $dataById->nama_paket= $request->nama_paket;
        $dataById->gbr_paket=$fileImage;
        $dataById->harga_paket=$request->harga_paket;
        $data=$dataById->save();
        if($data){
            return response([
                'pesan'=>'Data paket berhasil di perbaharui',
                'data'=>$data
            ],200);

        }
    }
}
