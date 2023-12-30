@extends('layouts.presensi')
@section('header')
    <-!-- App Header-->
        <div class="appHeader bg-primary text-light">
            <div class="left">
                <a href="javascript:;" class="headerButton goBack">
                    <ion-icon name = "chevron-back-outline"></ion-icon>
                </a>
            </div>
            <div class="pageTitle">Edit Profile</div>
            <div class="right"></div>
        </div>
        <-!--* App Header-->
        @endsection

        @section('content')
        <div class="row" style="margin-top: 4rem; text-align: center">
            <div class="col">
                @php
                    $messageSuccess = Session::get('success');
                    $messageError = Session::get('error');
                @endphp

                @if (Session::get('success'))
                <div class="alert alert-success">
                    {{$messageSuccess}}
                </div>     
                @endif

                @if (Session::get('error'))
                < class="alert alert-danger">
                    {{$messageError}}
                </div>
                @endif
            </div>
        </div>

            <form action="/presensi/{{$tni_al->nrp}}/updateProfile" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col">
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" value="{{$tni_al->nama_lengkap}}" name="nama_lengkap"
                                placeholder="Nama Lengkap" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" value="{{$tni_al->jabatan}}" name="jabatan" placeholder="Jabatan"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" value="{{$tni_al->no_hp}}" name="no_hp" placeholder="No. HP"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="custom-file-upload" id="fileUpload1">
                        <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                        <label for="fileuploadInput">
                            <span>
                                <strong>
                                    <ion-icon name="cloud-upload-outline" role="img" class="md hydrated"
                                        aria-label="cloud upload outline"></ion-icon>
                                    <i>Tap to Upload</i>
                                </strong>
                            </span>
                        </label>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <button type="submit" class="btn btn-primary btn-block">
                                <ion-icon name="refresh-outline"></ion-icon>
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        @endsection
