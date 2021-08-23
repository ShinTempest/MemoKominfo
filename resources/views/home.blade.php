@extends('layouts.admin')
@section('content')
<style>
    body {
      background-image: url('images/background_login.png');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }

    #search-berita {
        width: 40%;
        height: 60px;
        padding-left: 15px;
        font-size: 17.5px;
        border: 0 transparent;
        border-radius: 5px;
        box-shadow: 5px 5px #bbbbbb;
    }

    .btn-keyword {
        width: 175px;
        margin: 0 10px;
    }
</style>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 mb-3">
                <h1 class="text-left font-weight-600 blue-font"><b>Selamat Datang {{$user->name}}</b></h1>
            </div>

            <div class="col-lg-3 d-flex justify-content-end">
                <h1 class="font-weight-bold mr-2 blue-font" id="time"></h1>
                <div>
                    <p class="text-end blue-font" id="date"></p>
                </div>
            </div>

            <div class="col-lg-12 pt-2 mb-5 center">
                <a href="{{ route('user.pelaporan.index') }}" class="btn btn-lapor item-center">Tambahkan Laporan<i class="fa fa-plus-circle pl-2" aria-hidden="true"></i></a>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-lg-12 col-md-12 text-center">
                            <input id="search-berita" type="text" placeholder="Cari kata kunci berita">
                        </div>

                        <br>
                        <br>

                        <div class="col-lg-12 col-md-12 text-center">
                            <a href="{{ route('user.pencarian.index') }}/index/Edy Rahmayadi" class="btn btn-lg btn-lapor item-center btn-keyword">Edy Rahmayadi</a>
                            <a href="{{ route('user.pencarian.index') }}/index/Sumut" class="btn btn-lg btn-lapor item-center btn-keyword">Sumut</a>
                            <a href="{{ route('user.pencarian.index') }}/index/Pemerintah Provinsi Sumatera Utara" class="btn btn-lg btn-lapor item-center btn-keyword">Pemprovsu</a>
                            <a href="{{ route('user.pencarian.index') }}/index/Musa Rajekshah" class="btn btn-lg btn-lapor item-center btn-keyword">Musa Rajekshah</a>
                        </div>

                        <br>
                        <br>

                        <div class="card card-block card-stretch card-height">
                            <div class="card-body text-center">
                                <h5 class="text-center font-weight-300 mb-2">Berita Terkini</h5>
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
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="col-lg-12 card">
                            <div class="card-body text-center">
                                <h5 class="text-center font-weight-300">Grafik Hari Ini</h5>
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
    <script>
        $(document).ready(function(){
            var dt = new Date();
            var hours = dt.getHours();
            var minutes = dt.getMinutes();
            minutes = minutes < 10 ? '0'+minutes : minutes;
            document.getElementById("time").innerHTML = (hours +"."+ minutes);

            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            document.getElementById("date").innerHTML = (days[dt.getDay()]) +","+"<br>"+ (("0"+dt.getDate()).slice(-2)) +"."+ (("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear());

            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount:5,
                searchResultLimit:5,
            });
        });

        var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
        var chartData = {
            labels: ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24"],
            datasets: [{
                label: 'Berita Positif',
                data: [{{$harian_positif[0]}}, {{$harian_positif[1]}}, {{$harian_positif[2]}}, {{$harian_positif[3]}}, {{$harian_positif[4]}}, {{$harian_positif[5]}}, {{$harian_positif[6]}}, {{$harian_positif[7]}}, {{$harian_positif[8]}}, {{$harian_positif[9]}}, {{$harian_positif[10]}}, {{$harian_positif[11]}}, {{$harian_positif[12]}}, {{$harian_positif[13]}},{{$harian_positif[14]}}, {{$harian_positif[15]}}, {{$harian_positif[16]}}, {{$harian_positif[17]}}, {{$harian_positif[18]}}, {{$harian_positif[19]}}, {{$harian_positif[20]}},{{$harian_positif[21]}}, {{$harian_positif[22]}}, {{$harian_positif[23]}}],
                backgroundColor: 'transparent',
                borderColor: colors[0],
                pointBackgroundColor: colors[0]
            },
            {
                label: 'Berita Negatif',
                data: [{{$harian_negatif[0]}}, {{$harian_negatif[1]}}, {{$harian_negatif[2]}}, {{$harian_negatif[3]}}, {{$harian_negatif[4]}}, {{$harian_negatif[5]}}, {{$harian_negatif[6]}}, {{$harian_negatif[7]}}, {{$harian_negatif[8]}}, {{$harian_negatif[9]}}, {{$harian_negatif[10]}}, {{$harian_negatif[11]}}, {{$harian_negatif[12]}}, {{$harian_negatif[13]}},{{$harian_negatif[14]}}, {{$harian_negatif[15]}}, {{$harian_negatif[16]}}, {{$harian_negatif[17]}}, {{$harian_negatif[18]}}, {{$harian_negatif[19]}}, {{$harian_negatif[20]}},{{$harian_negatif[21]}}, {{$harian_negatif[22]}}, {{$harian_negatif[23]}}],
                backgroundColor: 'transparent',
                borderColor: colors[2],
                pointBackgroundColor: colors[2]
            }]
        };

        var chLine = document.getElementById("chLine");
        if (chLine) {
            new Chart(chLine, {
                type: 'line',
                data: chartData,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: false
                            }
                        }]
                    },
                    legend: {
                        display: true,
                        position:'bottom'
                    }
                }
            });
        }

        $("#search-berita").keypress(function (e) {
            if (e.which == 13) window.location.href = "{{ route('user.pencarian.index') }}/index/" + $("#search-berita").val();
        });
    </script>
@endsection
