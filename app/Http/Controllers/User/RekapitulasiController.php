<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\RoleUser;
use App\Pelaporan;
use Illuminate\Support\Facades\DB;


class RekapitulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_user = auth()->user()->id;
        $user = User::find($id_user);
        $role_user = RoleUser::find($id_user);
        $berita_positif = DB::select("select DAYNAME(updated_at) as 'day', count(updated_at) as 'jumlah' from berita where jenis_berita = 'positif'group by day");
        $berita_negatif = DB::select("select DAYNAME(updated_at) as 'day', count(updated_at) as 'jumlah' from berita where jenis_berita = 'negatif'group by day");
        $i = 0;
        $dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];;
        $positif = array(0,0,0,0,0,0,0);
        $negatif = array(0,0,0,0,0,0,0);
        foreach($dayNames as $hari){
            foreach($berita_positif as $data){
                if($hari == $data->day){
                        $positif[$i] = $data->jumlah;
                }  
            }
            $i++;
        }
        $i =0;
        foreach($dayNames as $hari){
            foreach($berita_negatif as $data){
                if($hari == $data->day){
                        $negatif[$i] = $data->jumlah;
                }  

            }  
            $i++;
        }
         
        return view('user.rekapitulasi.index', compact('user','role_user', 'positif', 'negatif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {   
        $id_user = auth()->user()->id;
        $user = User::find($id_user);
        $role_user = RoleUser::find($id_user);
        $data = DB::table('berita')->select('*')->orderBy('created_at', 'desc')->get();
        return view('user.rekapitulasi.view', compact('user','role_user', 'data'))->with('i');
    }

    public function view($id) 
    {
        $data = Pelaporan::where('id')->get();
        return view('user.rekapitulasi.detail', compact('data'));
    }

    public function detail()
    {   
        $id_user = auth()->user()->id;
        $user = User::find($id_user);
        $role_user = RoleUser::find($id_user);
        return view('user.rekapitulasi.detail', compact('user','role_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pelaporan::where('id', $id)->get();
        return view('user.rekapitulasi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'kategori_berita' => 'required',
            'isi_berita' => 'required',
            'media' => 'required',
            'inlineRadioOptions' => 'required',
            'saran' => 'required',
            'upload_gambar' => 'image|nullable|max:10000'

        ]);

        if($request->hasFile('upload_gambar')){
            $path_file = 'images/';
            $store_file = date('YmdHis') . "." . $request->upload_gambar->getClientOriginalExtension();
            $request->upload_gambar->move($path_file, $store_file);

            DB::table('berita')
            ->where('id',$id)
            ->update([
                'judul_berita' => $request['judul'],
                'kategori_berita' => $request['kategori_berita'],
                'isi_berita' => $request['isi_berita'],
                'media' => $request['media'],
                'jenis_berita' => $request['inlineRadioOptions'],
                'saran' => $request['saran'],
                'upload_gambar' => $store_file, 
            ]);
        return redirect()->back()->back()->with([
            'status'=>'success',
            'message'=>'Berhasil mengedit laporan'
        ]);
        }

        DB::table('berita')
            ->where('id',$id)
            ->update([
                'judul_berita' => $request['judul'],
                'kategori_berita' => $request['kategori_berita'],
                'isi_berita' => $request['isi_berita'],
                'media' => $request['media'],
                'jenis_berita' => $request['inlineRadioOptions'],
                'saran' => $request['saran'], 
            ]);
        return redirect()->route('user.rekapitulasi.index')->with([
            'status'=>'success',
            'message'=>'Berhasil mengedit laporan'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pelaporan::where('id', $id)->delete();
        return redirect()->back()->with([
            'status'=>'success',
            'message'=>'Berhasil dihapus'
        ]);;
    }
}
