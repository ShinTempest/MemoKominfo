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

    #search-berita {
        width: 50%;
        height: 50px;
        padding-left: 15px;
        font-size: 17.5px;
        border: 0 transparent;
        border-radius: 5px;
        box-shadow: 5px 5px #bbbbbb;
    }

    .container-berita-content {
        display: inline;
    }

    .berita-judul {
        margin: 0 0 20px 0;
    }
</style>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row text-center">
                    <div class="col-lg-12 col-md-12 text-center">
                        <input id="search-berita" type="text" placeholder="Cari kata kunci berita">
                    </div>

                    <br>
                    <br>
                    <br>
                    <br>

                    <div class="col-lg-12 col-md-12 text-center">
                        <button class="btn btn-lg btn-lapor item-center" onclick="updateSearch('Edy Rahmayadi')">Edy Rahmayadi</button>
                        <button class="btn btn-lg btn-lapor item-center" onclick="updateSearch('Sumut')">Sumut</button>
                        <button class="btn btn-lg btn-lapor item-center" onclick="updateSearch('Pemerintah Provinsi Sumatera Utara')">Pemprovsu</button>
                        <button class="btn btn-lg btn-lapor item-center" onclick="updateSearch('Musa Rajekshah')">Musa Rajekshah</button>
                    </div>

                    <br>
                    <br>
                    <br>
                    <br>

                    <div class="row" id="container-berita"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function updateSearch(keyword) {
            $.get(`https://newsapi.org/v2/everything?q=${keyword}&apiKey=c78e97c1fe9841188d8715e78cfc452c`, function(response) {
                var berita = "";
                for (var article of response.articles) {
                    var content = article.content;
                    content = content.slice(0, content.indexOf(" [+"));
                    berita += `
                        <div class="col-md-4 col-md-4 container-berita-content">
                            <div class="card berita text-justify">
                                <img class="card-img-top" src="${article.urlToImage}">
                                <div class="card-body">
                                    <h4 class="berita-judul text-center">${article.title}</h4>
                                    <p>${content} <a href="${article.url}">Lihat selengkapnya</a></p>

                                </div>
                            </div>
                        </div>
                    `
                }
                document.getElementById("container-berita").innerHTML = berita;
            });
        }

        var keyword = window.location.pathname.replace('/user/pencarian/index/','');
        updateSearch(keyword);

        $("#search-berita").keypress(function (e) {
            if (e.which == 13) updateSearch($("#search-berita").val());
        });
    </script>
@endsection
