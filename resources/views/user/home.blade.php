@extends('layouts.user')
@section('content')
<style>
body {
  background-image: url('images/background_login.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
<div class="content-page ">
    <div class="container-fluid">
        <div class="row">   
                <div class="col-lg-9 mb-3">
                    <h1 class="text-left font-weight-600">Selamat Datang {{$user->name}}</h1>
                </div>
                <div class="col-lg-3 d-flex justify-content-end">
                    <p class="" id="time"></p>
                        <div>
                        <p class="text-end" id="date"></p>
                        </div>
                </div>
                
            <div class="col-lg-12 pt-2 center">
                <a href="{{ route('user.pelaporan.index')}}" class="btn btn-lapor item-center"><i class="fa fa-plus-circle pl-2" aria-hidden="true"></i> Tambah Laporan</a>
            </div>

            <div class="col-lg-12 col-md-12">
                <h5 class="text-center font-weight-300">Berita Terkini</h5>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body text-center">
                                <div id="test" class="carousel slide" data-ride="carousel">
                                    <ul class="carousel-indicators">
                                        <li data-target="#test" data-slide-to="0" class="active"></li>
                                        <li data-target="#test" data-slide-to="1"></li>
                                        <li data-target="#test" data-slide-to="2"></li>
                                    </ul>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active" style="height:300px">
                                            <a id="firsturl" href={{$firstUrl}}>
                                            <img id="firstimage" class="img-fluid d-block mx-auto" src="{{$firstImage}}" alt="..." style="width:1110px; height:500px;">
                                                <div class="carousel-caption  d-md-block">
                                                    <p class="title">{{$firstTitle}}</p>
                                                </div>
                                            </a>
                                        
                                        </div>

                                        <div class="carousel-item" style="height:300px">
                                            <a id="secondurl" href={{$secondUrl}}>
                                            <img id="secondimage" class="img-fluid d-block mx-auto" src="{{$secondImage}}" alt="..." style="width:1110px; height:500px;">
                                                <div class="carousel-caption  d-md-block">
                                                    <p class="title">{{$secondTitle}}</p>
                                                </div>
                                            </a>
                                        
                                        </div>

                                        <div class="carousel-item" style="height:300px">
                                            <a id="thirdurl" href={{$thirdUrl}}>
                                            <img id="thirdimage" class="img-fluid d-block mx-auto" src="{{$thirdImage}}" alt="..." style="width:1110px; height:500px;">
                                                <div class="carousel-caption  d-md-block">
                                                    <p class="title">{{$thirdTitle}}</p>
                                                </div>
                                            </a>
                                        
                                        </div>
                                    </div>

                                    <a class="carousel-control-prev" href="#test" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#test" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div><br>
                            </div>
                            <div class="col-lg-12">
                                <canvas id="chLine" width="50px " height="10px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection
