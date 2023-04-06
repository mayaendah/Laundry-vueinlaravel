<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paket;
use App\Models\keranjang;
use App\Models\detail_header;
use App\Models\detail_pesanan;
use App\Models\pesanan;

class transaksiController extends Controller
{
    // protected $idTrans;

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function checkOut(Request $request)
    {
        $nama_member = $request->nama_member;
        $harga_total = $request->harga_total;

        $data_header = detail_header::create([
            'tanggal_transaksi' => date('Y-m-d')
        ]);

        $id_header = $data_header::latest()->first()->id_detail_header;

        $dataDetailKeranjang = $request->get_keranjangs;

        foreach ($dataDetailKeranjang as $item => $val) {
            $idHeader = $id_header;
            $idPaket = $val['paket'];
            $beratPaket = $val['berat_paket'];
            $hargaPaket = $val['harga_paket'];

            detail_pesanan::create([
                'id_detail_header' => $idHeader,
                'id_paket' => $idPaket,
                'berat_paket' => $beratPaket,
                'harga_paket' => $hargaPaket
            ]);
        }

        pesanan::create([
            'id_header' => $id_header,
            'nama_member' => $nama_member,
            'total_biaya' => $harga_total
        ]);

        return response()->json([
            'pesan' => 'success',
        ]);
    }

    public function getAllKeranjang()
    {
        $data = keranjang::join('pakets', 'pakets.id', '=', 'keranjangs.paket')->get(['keranjangs.*', 'pakets.*']);
        if ($data) {
            return response()->json([
                'pesan' => 'susscess',
                'data' => $data
            ]);
        }
    }

    public function getPaket()
    {
        $data = paket::all();
        if ($data) {
            return response()->json([
                'pesan' => 'success',
                'data' => $data
            ], 200);
        }
    }

    public function getPaketById($id)
    {
        $data = paket::findOrFail($id);
        if ($data) {
            return response()->json([
                'pesan' => 'success',
                'data' => $data
            ], 200);
        }
    }

    public function simpanKeranjang(Request $request)
    {
        $request->validate([
            'berat_paket' => 'required',
            'ket_paket' => 'required',
            'paket' => 'required',
        ]);



        $data = keranjang::create([
            'paket' => $request->paket,
            'berat_paket' => $request->berat_paket,
            'ket_paket' => $request->ket_paket,
        ]);
        if ($data) {
            return response()->json([
                'pesan' => 'susscess',
                'data' => $data
            ]);
        }
    }

    public function hapusKeranjang($id){
        $hapusKeranjang=keranjang::where('paket',$id)->first();
        if($hapusKeranjang){
            $hapusKeranjang->delete();
            return response()->json([
                'pesan'=>'paket berhasil di hapus',
                'code'=>200
            ]);
        }
    }
}
