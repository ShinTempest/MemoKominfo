@extends('layouts.admin')
@section('content')

<style>
    body {
        height: 100%;
        background-image:url('{{url('images/background_login.png')}}');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
</style>

<div class="content-page">
    <div class="container">
        <div class="card" style="background-color:#F3F8FF">
            <div class="card-header d-flex justify-content-between" style="background-color:#FFFFFF">
               <div class="header-title m-2">
                  <h4 class="card-title m-2">Edit Profil</h4>
               </div>
            </div>
            <div class="panel-body">
            @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4 text-center">
                    <img class="border-primary rounded m-5" src="/images/logo_sumut.png" id="preview" alt="Avatar" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                </div>

            <div class="col-sm-12 col-md-8 col-lg-8">
                
            <form class="pb-2 mr-5" action="{{route('user.profil.index')}}/${user.id_user}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form">
                            <label class="col-form-label mt-4">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{$user->name}}">
                        </div>
                        <div class="form">
                            <label class="col-form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}" readonly>
                        </div>
                        <div class="form">
                            <label class="col-form-label">Kata Sandi Lama </label>
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="input-old_password" name="old_password" value="">
                                @error('old_password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror    
                        </div>
                        <div class="form">
                            <label class="col-form-label @error('password') is-invalid @enderror">Kata Sandi Baru</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="input-password" name="password" value="">
                                @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Konfirmasi Kata Sandi </label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="input-password_confirmation" name="password_confirmation" value="">
                                @error('password_confirmation')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                        </div>

                    <div class="float-right p-4">
                        <a class="btn btn-danger m-2" href="{{ route('user.profil.index') }}">Batalkan</a>
                        <input class="btn btn-success m-2" type="submit" value="Simpan">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js_inline')
<script>

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#input-image").change(function() {
                readURL(this);
                $("#preview").show();
            });
</script>
@endsection