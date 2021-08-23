<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\RoleUser;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $id_user = auth()->user()->id;
        $user = User::find($id_user);
        $role_user = RoleUser::find($id_user);

        $url = "http://newsapi.org/v2/top-headlines?country=id&sortBy=publishedAt&apiKey=1bc17eb57ac9417eafe4ba36eee8620d";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        $firstImage = $result->articles[0]->urlToImage;
        $secondImage = $result->articles[1]->urlToImage;
        $thirdImage = $result->articles[2]->urlToImage;
        $firstUrl = $result->articles[0]->url;
        $secondUrl = $result->articles[1]->url;
        $thirdUrl = $result->articles[2]->url;
        $firstTitle = $result->articles[0]->title;
        $secondTitle = $result->articles[1]->title;
        $thirdTitle = $result->articles[2]->title;

        $harian = $this->harian();
        $harian_positif = $harian[0];
        $harian_negatif = $harian[1];

        return view('home', compact('firstImage', 'secondImage', 'thirdImage', 'firstUrl', 'secondUrl', 'thirdUrl', 'firstTitle', 'secondTitle', 'thirdTitle', 'user', 'role_user', 'harian_positif', 'harian_negatif'));
    }

    public function harian()
    {
        $berita_positif = DB::select("SELECT HOUR(updated_at) AS hour, count(updated_at) AS jumlah FROM berita WHERE jenis_berita = 'option1' AND DAY(updated_at) = DAY(NOW()) GROUP BY hour");
        $berita_negatif = DB::select("SELECT HOUR(updated_at) AS hour, count(updated_at) AS jumlah FROM berita WHERE jenis_berita = 'option2' AND DAY(updated_at) = DAY(NOW()) GROUP BY hour");

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
}
