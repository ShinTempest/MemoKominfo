<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\RoleUser;
use App\Pelaporan;
use Illuminate\Support\Facades\Auth;


class PelaporanController extends Controller
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

        return view('user.pelaporan.index', compact('user','role_user'));
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
        }else{
            return $request;
        }

        $pelaporan = new Pelaporan();
        $pelaporan->judul_berita= $request['judul'];
        $pelaporan->kategori_berita= $request['kategori_berita'];
        $pelaporan->isi_berita= $request['isi_berita'];
        $pelaporan->media= $request['media'];
        $pelaporan->jenis_berita= $request['inlineRadioOptions'];
        $pelaporan->saran= $request['saran'];
        $pelaporan->upload_gambar = $store_file;
        $pelaporan -> user_id = Auth::id();
        $pelaporan->save();
        return redirect()->route('user.pelaporan.index')->with([
            'status'=>'success',
            'message'=>'Berhasil membuat laporan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
