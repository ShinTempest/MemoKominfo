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
    .date {
        margin: 20px 10px 20px 10px;
    }

    .date .datepicker-days tr {
        height: 50px;
    }
</style>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="blue-font">Kategori</h5>
                        <div class="dropdown">
                            <select class="form-control input-sm" id="kategori_berita" name="kategori_berita" style="background-color: #F3F8FF" onchange="updateChart()">
                                <option value="0">Semua</option>
                                <option value="1">Edy Rahmayadi</option>
                                <option value="2">Musa Rajekshah</option>
                                <option value="3">Pemprovsu</option>
                                <option value="4">Sumut</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="date" id="tanggal"></div>
                </div>
            </div>
            <div class="col-lg-7">
                <div>
                    <h3 class="font-weight-bold blue-font" id="date"></h3>
                </div><br>
                <div>
                    <h5 class="text-left font-weight-300 blue-font">Grafik Hari Ini
                        <span class="float-right fs-2"><a href="{{ route('user.rekapitulasi.index')}}/view">Lihat detail</a></span></h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <canvas id="chLine" width="50px" height="13px"></canvas>
                    </div>
                </div>
                <div>
                    <h5 class="text-left font-weight-300 blue-font">Grafik Minggu Ini</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <canvas id="chLine1" width="50px" height="13px"></canvas>
                    </div>
                </div>
                <div>
                    <h5 class="text-left font-weight-300 blue-font">Grafik Bulan Ini</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <canvas id="chLine2" width="50px" height="13px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function updateDate(date) {
        var dt = new Date(date);
        const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        document.getElementById("date").innerHTML = (days[dt.getDay()]) +","+ "  "+ (("0"+dt.getDate()).slice(-2)) +"."+ (("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear());
    }

    function createChart(chLineLabel, chLinePositifData, chLineNegatifData, chLineElementId) {
        var colors = ['#007bff','#333333'];
        var chLineData = {
            labels: chLineLabel,
            datasets: [{
                data: chLinePositifData,
                label: 'Berita Positif',
                backgroundColor: 'transparent',
                borderColor: colors[0],
                pointBackgroundColor: colors[0],
            }, {
                data: chLineNegatifData,
                label: 'Berita Negatif',
                backgroundColor: 'transparent',
                borderColor: colors[1],
                pointBackgroundColor: colors[1],
            }],
        };
        var chartOptions = {
            type: 'line',
            data: chLineData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false,
                        }
                    }],
                },
                legend: {
                    display: true,
                    position:'bottom',
                }
            }
        }

        var chLine = document.getElementById(chLineElementId);
        if (chLine) new Chart(chLine, chartOptions);
    }

    function updateChart(date) {
        if (!date) {
            var tzoffset = (new Date()).getTimezoneOffset() * 60000;
            date = new Date(Date.now() - tzoffset).toISOString().slice(0, 10);
        }

        updateDate(date);

        var selectedKategori = $("select#kategori_berita").children("option:selected").val();

        $.get('/user/rekapitulasi/get_harian/' + date + '/' + selectedKategori, function(response) {
            chLineLabel = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
            createChart(chLineLabel, response.harian_positif, response.harian_negatif, "chLine");
        });

        $.get('/user/rekapitulasi/get_mingguan/' + date + '/' + selectedKategori, function(response) {
            chLine1Label = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            createChart(chLine1Label, response.mingguan_positif, response.mingguan_negatif, "chLine1");
        });

        $.get('/user/rekapitulasi/get_bulanan/' + date + '/' + selectedKategori, function(response) {
            var daysInMonth = new Date(2021, 8, 0).getDate(), chLine2Label = [];
            for (var i = 1; i <= daysInMonth; i++) chLine2Label.push(i);
            createChart(chLine2Label, response.bulanan_positif, response.bulanan_negatif, "chLine2");
        });
    }

    updateChart();
</script>

@endsection
