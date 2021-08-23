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

        return view('user.rekapitulasi.index', compact('user', 'role_user'));
    }

    public function get_harian(Request $request, $tanggal, $kategori = 0)
    {
        $harian = $this->harian($tanggal, $kategori);

        return response()->json([
            "harian_positif" => $harian[0],
            "harian_negatif" => $harian[1],
        ]);
    }

    public function harian($tanggal, $kategori)
    {
        $kategoriFilter = "";
        if ($kategori != 0) $kategoriFilter = " AND kategori_berita=$kategori";

        $berita_positif = DB::select("SELECT HOUR(updated_at) AS hour, count(updated_at) AS jumlah FROM berita WHERE jenis_berita = 'positif' AND DAY(updated_at) = DAY('$tanggal') $kategoriFilter GROUP BY hour");
        $berita_negatif = DB::select("SELECT HOUR(updated_at) AS hour, count(updated_at) AS jumlah FROM berita WHERE jenis_berita = 'negatif' AND DAY(updated_at) = DAY('$tanggal') $kategoriFilter GROUP BY hour");

        $positif = $negatif = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        $hours = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
        for ($i = 0; $i < count($hours); $i++) {
            foreach ($berita_positif as $data) {
                if ($hours[$i] == $data->hour) {
                    $positif[$i] = $data->jumlah;
                }
            }

            foreach ($berita_negatif as $data) {
                if ($hours[$i] == $data->hour) {
                    $negatif[$i] = $data->jumlah;
                }
            }
        }

        return array($positif, $negatif);
    }

    public function get_mingguan(Request $request, $tanggal, $kategori = 0)
    {
        $mingguan = $this->mingguan($tanggal, $kategori);

        return response()->json([
            "mingguan_positif" => $mingguan[0],
            "mingguan_negatif" => $mingguan[1],
        ]);
    }

    public function mingguan($tanggal, $kategori)
    {
        $kategoriFilter = "";
        if ($kategori != 0) $kategoriFilter = " AND kategori_berita=$kategori";

        $berita_positif = DB::select("SELECT DAYNAME(updated_at) AS dayName, count(updated_at) AS jumlah FROM berita WHERE jenis_berita = 'positif' AND WEEK(updated_at) = WEEK('$tanggal') $kategoriFilter GROUP BY dayName");
        $berita_negatif = DB::select("SELECT DAYNAME(updated_at) AS dayName, count(updated_at) AS jumlah FROM berita WHERE jenis_berita = 'negatif' AND WEEK(updated_at) = WEEK('$tanggal') $kategoriFilter GROUP BY dayName");

        $positif = $negatif = array(0, 0, 0, 0, 0, 0, 0);

        $dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        for ($i = 0; $i < count($dayNames); $i++) {
            foreach ($berita_positif as $data) {
                if ($dayNames[$i] == $data->dayName) {
                    $positif[$i] = $data->jumlah;
                }
            }

            foreach ($berita_negatif as $data) {
                if ($dayNames[$i] == $data->dayName) {
                    $negatif[$i] = $data->jumlah;
                }
            }
        }

        return array($positif, $negatif);
    }

    public function get_bulanan(Request $request, $tanggal, $kategori = 0)
    {
        $bulanan = $this->bulanan($tanggal, $kategori);

        return response()->json([
            "bulanan_positif" => $bulanan[0],
            "bulanan_negatif" => $bulanan[1],
        ]);
    }

    public function bulanan($tanggal, $kategori)
    {
        $kategoriFilter = "";
        if ($kategori != 0) $kategoriFilter = " AND kategori_berita=$kategori";

        $berita_positif = DB::select("SELECT DAY(updated_at) AS day, count(updated_at) AS jumlah FROM berita WHERE jenis_berita = 'positif' AND MONTH(updated_at) = MONTH('$tanggal') $kategoriFilter GROUP BY day");
        $berita_negatif = DB::select("SELECT DAY(updated_at) AS day, count(updated_at) AS jumlah FROM berita WHERE jenis_berita = 'negatif' AND MONTH(updated_at) = MONTH('$tanggal') $kategoriFilter GROUP BY day");

        $numberOfDays = cal_days_in_month(CAL_GREGORIAN,8,2021);

        $dayNumbers = $positif = $negatif = array();
        for ($i = 1; $i <= $numberOfDays; $i++) {
            array_push($dayNumbers, $i);
            array_push($positif, 0);
        }
        $negatif = $positif;

        for ($i = 0; $i < count($dayNumbers); $i++) {
            foreach ($berita_positif as $data) {
                if ($dayNumbers[$i] == $data->day) {
                    $positif[$i] = $data->jumlah;
                }
            }

            foreach ($berita_negatif as $data) {
                if ($dayNumbers[$i] == $data->day) {
                    $negatif[$i] = $data->jumlah;
                }

            }
        }

        return array($positif, $negatif);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
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
        return view('user.rekapitulasi.detail', compact('user', 'role_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
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
     * @param int $id
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
