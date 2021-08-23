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
        <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h5 class="card-title m-2">Pelaporan Berita</h5>
               </div>
            </div>
            <div class="card-body">

               <div class="container-fluid">

                        <form id="file-upload-form" method="POST" action="{{ route('user.pelaporan.index') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-6">
                                        <div class="form-group" >
                                            <label class="font-weight-bold" for="judul_berita">Judul</label>
                                            <input id="judul" name="judul" type="text" class="form-control border border-dark form-control{{ $errors->has('judul_berita') ? ' is-invalid' : '' }}" id="judul_berita" value="{{ old('judul_berita') }}">
                                            @if ($errors->has('judul_berita'))
                                                <small class="text-danger">{{ $errors->first('judul_berita') }}</small>
                                            @endif
                                        </div>
                                </div>
                                <div class="col-5">
                                        <div class="form-group dropdown">
                                            <label class="font-weight-bold" for="sel1">Kategori Berita</label>
                                                <select class="form-control input-sm border border-dark" id="kategori_berita" name="kategori_berita">
                                                    <option value="1">Edy Rahmayadi</option>
                                                    <option value="2">Musa Rajekshah</option>
                                                    <option value="3">Pemprovsu</option>
                                                    <option value="4">Sumut</option>
                                                </select>
                                        </div> 
                                </div>
                                <div class="col-8">
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="isi">Isi Berita</label>
                                            <textarea class="form-control border border-dark" rows="5" id="isi_berita" name="isi_berita"></textarea>
                                        </div>

                                        <div class="form-group multidrop">
                                            <label class="font-weight-bold" for="media">Media</label>
                                            <br>
                                            <select multiple class="drop-media" id="choices-multiple-remove-button" name="media" placeholder="Pilih media berita.." >
                                                <option value="detik.com">detik.com</option>
                                                <option value="Kompas.com">Kompas.com</option>
                                                <option value="Kumparan.com">Kumparan.com</option>
                                                <option value="CNNIndonesia.com">CNNIndonesia.com</option>
                                                <option value="Antaranews.com">Antaranews.com</option>
                                                <option value="Analisadaily.com">Analisadaily.com</option>
                                                <option value="Waspada.co.id">Waspada.co.id</option>
                                                <option value="Mudanews.com">Mudanews.com</option>
                                                <option value="Medan.Tribunnews.com">Medan.Tribunnews.com</option>
                                                <option value="Realitasonline.i">Realitasonline.id</option>
                                                <option value="Metropublik.com">Metropublik.com</option>
                                                <option value="Orbitbisnisdaily.com">Orbitbisnisdaily.com</option>
                                                <option value="Medanbisnisdaily.com">Medanbisnisdaily.com</option>
                                                <option value="gosumut.com">gosumut.com</option>
                                                <option value="intipos.com">intipos.com</option>
                                                <option value="Rmolsumut.id">Rmolsumut.id</option>
                                                <option value="kabarmedan.com">kabarmedan.com</option>
                                                <option value="Kliksumut.com">Kliksumut.com</option>
                                                <option value="asarpua.com">asarpua.com</option>
                                                <option value="eksisnews.com">eksisnews.com</option>
                                                <option value="deteksi.co">deteksi.co</option>
                                                <option value="medanmerdeka.com">medanmerdeka.com</option>
                                                <option value="medanmerdeka.com">medanmerdeka.com</option>
                                                <option value="sumutcyber.com">sumutcyber.com</option>
                                                <option value="matabangsa.com">matabangsa.com</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-1 font-weight-bold" for="jenis_berita">Jenis Berita</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="positif">
                                                    <label class="form-check-label" for="inlineRadio1">Positif</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="negatif">
                                                    <label class="form-check-label" for="inlineRadio2">Negatif</label>
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-1 font-weight-bold" for="saran">Saran</label>
                                            <textarea class="form-control border border-dark" rows="5" id="saran" name="saran"></textarea>
                                        </div>

                                        <label class="mb-1 font-weight-bold" for="upload_gambar">Upload Gambar</label>
                                        {{-- <div class="dropzone-wrapper">
                                                <div class="dropzone-desc">
                                                <i class="fas fa-upload" ></i>
                                                <p>Choose an image file or drag it here.</p>
                                            </div>
                                            <input type="file" name="img_logo" class="dropzone">
                                        </div> --}}
                                        <br>
                                        <input type="file" name="upload_gambar">
                                        <br><br>                                      
                                </div>
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <input class="btn btn-primary mr-4" type="reset" value="Batalkan">
                                    <input class="btn btn-primary" type="submit" value="Simpan">
                                </div>
                            </div>
                        </form>

               </div>


            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
    <Script>
        $(document).ready(function(){
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true,
        maxItemCount:5,
        searchResultLimit:5,
        });
        });

    </Script>
@endsection