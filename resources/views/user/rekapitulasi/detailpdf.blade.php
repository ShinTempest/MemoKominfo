<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pemantauan Opini Publik Diskominfo Medan</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
</head>
<body>
<div class="content-page">
    <div class="container-fluid">
        <center>
        <div class="card">
            <div class="card-header d-flex justify-content-center">
               <div class="header-title">
                  <h2 class="card-title" style="font-weight:bold">Laporan Pemantauan Opini Publik Diskominfo Medan</h2>
                  <p class="text-center" id="date"></p>
               </div>
            </div>
            <div class="card-body">
                
               <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-center">
                            @foreach($data as $datas)         
                            <table border="2" class="table table-bordered">
                                <tr>
                                    <td class="font-weight-bold" style="font-weight:bold;">Judul Berita</td>
                                    <td style="height: 70px; margin-left:20px;">{{$datas -> judul_berita}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="font-weight: bold;">Kategori Berita</td>
                                    <td style="height: 70px;">{{$datas -> kategori_berita}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="font-weight: bold;">Isi Berita</td>
                                    <td style="height: 70px;">{{$datas -> isi_berita}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="font-weight: bold;">Media</td>
                                    <td style="height: 70px;">{{$datas -> media}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="font-weight: bold;">Jenis Berita</td>
                                    <td style="height: 70px;">{{$datas -> jenis_berita}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="font-weight: bold;">Saran</td>
                                    <td style="height: 70px;">{{$datas -> saran}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="font-weight: bold;">Gambar</td>
                                    <td style="height: 70px;"><img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('images/'.$datas->upload_gambar)))}}" alt="Gambar" width="50px" height="50px"></td>
                                </tr>

                            </table>
                            @endforeach
                        </div>
                    </div>
               </div>
            </div>
        </div>
        </center>
    </div>
</div>

 
</body>
</html>

