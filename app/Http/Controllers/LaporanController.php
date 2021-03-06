<?php

namespace App\Http\Controllers;
use App\Transaksi;
use App\Buku;
use PDF;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function transaksi()
    {
        return view('laporan.transaksi');
    }
    public function transaksiPdf(Request $request)
    {
        $query = Transaksi::query();
        if($request->get('status')){
            if($request->get('status') == 'Pinjam'){
                $query->where('status','Pinjam');
            }else{
                $query->where('status','Kembali');
            }
        }
        $datas = $query->get();
        $pdf = PDF::loadView('laporan.transaksi_pdf',compact('datas'));
        return $pdf->download('laporan_transaksi '.date('Y-m-d_H-i-s').'.pdf');
    }
    public function buku()
    {
        return view('laporan.buku');
    }
    public function bukuPdf()
    {
        $datas = Buku::all();
        $pdf = PDF::loadView('laporan.buku_pdf',compact('datas'));
        return $pdf->download('laporan_pdf '.date('d-m-yy_H-i-s').'.pdf');

    }
}
