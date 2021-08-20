<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelaporan;
use PDF;

class ViewController extends Controller
{
    public function view($id) 
    {
        $data = Pelaporan::where('id', $id)->get();
        return view('user.rekapitulasi.detail', compact('data', 'id'));
    }

    public function cetak_pdf($id)
    {
        $data = Pelaporan::where('id', $id)->get();
        
    	$pdf = PDF::setOptions([
            'images' => true
        ])->loadview('user.rekapitulasi.detailpdf', ['data'=>$data]);
    	return $pdf->download('laporan.pdf');
    }
}
