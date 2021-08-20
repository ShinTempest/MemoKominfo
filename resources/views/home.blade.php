@extends('layouts.admin')
@section('content')
<style>
body {
  background-image: url('images/background_login.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">   
                <div class="col-lg-9 mb-3">
                    <h1 class="text-left font-weight-600">Selamat Datang {{$user->name}}</h1>
                </div>
                <div class="col-lg-3 d-flex justify-content-end">
                        <h1 class="font-weight-bold mr-2" id="time"></h1>
                        <div>
                        <p class="text-end" id="date"></p>
                        </div>
                </div>
                
            <div class="col-lg-12 pt-2 mb-5 center">
                <a href="{{ route('user.pelaporan.index') }}" class="btn btn-lapor item-center"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambahkan Laporan</a>
            </div><br>

            <div class="col-lg-12 col-md-12">

                <div class="row">
                    <div class="col-lg-12 col-md-12">
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
        var dt = new Date();
        var hours = dt.getHours();
        var minutes = dt.getMinutes();
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes;
        document.getElementById("time").innerHTML = (hours +"."+ minutes);
    </script>

    <script>
        var dt = new Date();
        const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        document.getElementById("date").innerHTML = (days[dt.getDay()]) +","+"<br>"+ (("0"+dt.getDate()).slice(-2)) +"."+ (("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear());
    </script>

    <script>
        $(document).ready(function(){
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true,
        maxItemCount:5,
        searchResultLimit:5,
        });
        });
    </script>

    <script>
        var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
        var chartData = {
                labels: ["S", "M", "T", "W", "T", "F", "S"],
                datasets: [{
                    label: 'Berita Positif',
                    data: [589, 283, 183, 503, 689, 492, 634],
                    backgroundColor: 'transparent',
                    borderColor: colors[0],
                    pointBackgroundColor: colors[0]
                },
                {   
                    label: 'Berita Negatif',
                    data: [339, 465, 493, 278, 389, 632, 374],
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
    </script>

@endsection
