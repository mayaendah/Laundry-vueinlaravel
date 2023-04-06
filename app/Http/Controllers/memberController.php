<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;

class memberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->middleware('auth:api');
    }

    public function simpanMember(Request $request){
        $request->validate([
            'nama_member'=>'required',
            'alamat_member'=>'required',
            'jenis_kelamin'=>'required',
            'tlp_member'=>'required'
        ]);

        $data=member::create([
            'nama_member'=>$request->nama_member,
            'alamat_member'=>$request->alamat_member,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'tlp_member'=>$request->tlp_member,
        ]);
        if($data){
            return response()->json([
                'pesan'=>'susscess',
                'data'=>$data
            ]);
        }

    }

    public function getMember(){
        $data=member::all();
        if($data){
            return response()->json([
                'pesan'=>'susscess',
                'data'=>$data
            ]);
        }
    }

    public function hapusMember($id){
        $data=member::findOrFail($id);
        if($data){
            $data->delete();
            return response([
                'pesan'=>'Data member berhasil di hapus'
            ],200);
        }

    }

    public function UbahMember($id){
        $data=member::where('id',$id)->first();
        if($data){
            return response([
                'pesan'=>'Data member berhasil di hapus',
                'data'=>$data
            ],200);
        }

    }

    public function updateMember(Request $request){
        $request->validate([
            'id_member'=>'required',
            'nama_member'=>'required',
            'alamat_member'=>'required',
            'jenis_kelamin'=>'required',
            'tlp_member'=>'required',
        ]);

        $dataById=member::where('id',$request->id_member)->first();
        $dataById->nama_member=$request->nama_member;
        $dataById->alamat_member=$request->alamat_member;
        $dataById->jenis_kelamin=$request->jenis_kelamin;
        $dataById->tlp_member=$request->tlp_member;
        $data=$dataById->save();
        if($data){
            return response([
                'pesan'=>'Data member berhasil di perbaharui',
                'data'=>$data
            ],200);

        }
    }
}
