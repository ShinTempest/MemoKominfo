<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MEMO KOMINFO</title>
    <link rel="icon" type="image/x-icon" href="/images/logo_sumut.ico">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/upload.css') }}" rel="stylesheet" />
</head>
<body>
<div class="content-page">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h5 class="card-title m-2" style="font-weight:bold">Data Berita Harian</h5>
               </div>
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
                                    <td><img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('images/'.$datas->upload_gambar)))}}" alt="Gambar" width="50px" height="50px"></td>
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
</body>
</html>

