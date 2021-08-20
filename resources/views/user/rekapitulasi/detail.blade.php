@extends('layouts.admin')
@section('content')
<style>
    body {
        height: 100%;
        background-color: #F3F8FF;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
</style>
<div class="content-page">
    <div class="container-fluid">
    <a class="btn btn-danger mb-3 mt-3" style="color:white" href={{url('/user/rekapitulasi/view')}}>Kembali</a><br>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h5 class="card-title m-2" style="font-weight:bold">Data Berita Harian</h5>
               </div>
               <a class="btn btn-success m-1" href="{{route('user.cetak_pdf', $id)}}" target="_blank"> <i class="fas fa-file-pdf"></i> Cetak PDF </a>
            </div>
            <div class="card-body">
                
               <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-center">
                            @foreach($data as $datas)         
                            <table border="1" class="table table-striped">
                                <tr>
                                    <td class="font-weight-bold" style="width: 30%">Judul Berita</td>
                                    <td>{{$datas -> judul_berita}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Kategori Berita</td>
                                    <td>{{$datas -> kategori_berita}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Isi Berita</td>
                                    <td>{{$datas -> isi_berita}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Media</td>
                                    <td>{{$datas -> media}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Jenis Berita</td>
                                    <td>{{$datas -> jenis_berita}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Saran</td>
                                    <td>{{$datas -> saran}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Gambar</td>
                                    <td><img src="{{asset('/images/'.$datas->upload_gambar)}}" alt="Gambar" width="50px" height="50px"></td>
                                </tr>

                            </table>
                            @endforeach
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
