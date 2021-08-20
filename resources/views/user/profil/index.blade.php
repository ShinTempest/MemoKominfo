@extends('layouts.admin')
@section('content')

<style>
    body {
        height: 100%;
        background-image: url('{{url('images/background_login.png')}}');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
</style>

<div class="content-page">
    <div class="container">
        <div class="card" style="height:500px; background-color:#F3F8FF">
            <div class="card-header d-flex justify-content-between" style="background-color:#FFFFFF">
               <div class="header-title">
                  <h4 class="card-title mt-2 ml-2">Profil</h4>
               </div>
                <div class="col-left">
                    <a href="{{ route('user.profil.index')}}/${user.id_user}/edit" class="btn btn-primary item-center mt-2 mr-2" style="color:">Edit Profil<i class="fa fa-pencil-square-o pl-2" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="content-page">
                <h3 class="text-center mt-5">Halo {{$user->name}}!</h3>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <img class="border-primary rounded" src="{{ url('images/Logo_sumut2.png') }}" alt="Avatar" style="width:140px; height:150px; margin-top:30px; margin-left:55px">
                </div>

                <div class="col-sm-12 col-md-8 col-lg-8">
                    <form class="pb-5 mr-5">
                        <div class="form">
                            <label class="col-form-label" style="margin-top:20px">Nama</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{$user->name}}">
                        </div>
                        <div class="form">
                            <label class="col-form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection