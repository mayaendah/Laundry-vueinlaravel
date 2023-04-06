<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\outlet;

class outletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->middleware('auth:api');
    }

    public function simpanOutlet(Request $request){
        $request->validate([
            'nama_outlet'=>'required',
            'alamat_outlet'=>'required',
            'tlp_outlet'=>'required'
        ]);

        $data=outlet::create([
            'nama_outlet'=>$request->nama_outlet,
            'alamat_outlet'=>$request->alamat_outlet,
            'tlp_outlet'=>$request->tlp_outlet,
        ]);
        if($data){
            return response()->json([
                'pesan'=>'susscess',
                'data'=>$data
            ]);
        }

    }

    public function getOutlet(){
        $data=outlet::all();
        if($data){
            return response()->json([
                'pesan'=>'susscess',
                'data'=>$data
            ]);
        }
    }

    public function hapusOutlet($id){
        $data=outlet::findOrFail($id);
        if($data){
            $data->delete();
            return response([
                'pesan'=>'Data Outlet berhasil di hapus'
            ],200);
        }

    }

    public function UbahOutlet($id){
        $data=outlet::where('id',$id)->first();
        if($data){
            return response([
                'pesan'=>'Data Outlet berhasil di hapus',
                'data'=>$data
            ],200);
        }

    }

    public function updateOutlet(Request $request){
        $request->validate([
            'id_outlet'=>'required',
            'nama_outlet'=>'required',
            'alamat_outlet'=>'required',
            'tlp_outlet'=>'required',
        ]);

        $dataById=outlet::where('id',$request->id_outlet)->first();
        $dataById->nama_outlet=$request->nama_outlet;
        $dataById->alamat_outlet=$request->alamat_outlet;
        $dataById->tlp_outlet=$request->tlp_outlet;
        $data=$dataById->save();
        if($data){
            return response([
                'pesan'=>'Data Outlet berhasil di perbaharui',
                'data'=>$data
            ],200);

        }
    }
}
