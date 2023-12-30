@extends('layouts.presensi')
@section('header')
    <-!-- App Header-->
        <div class="appHeader bg-primary text-light">
            <div class="left">
                <a href="javascript:;" class="headerButton goBack">
                    <ion-icon name = "chevron-back-outline"></ion-icon>
                </a>
            </div>
            <div class="pageTitle">Izin Anggota</div>
            <div class="right"></div>
        </div>
        <-!--* App Header-->
        @endsection

        @section('content')
            <div class="row" style="margin-top: 70px">
                <div class="col">
                    @php
                        $messageSuccess = Session::get('success');
                        $messageError = Session::get('error');
                    @endphp

                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ $messageSuccess }}
                        </div>
                    @endif

                    @if (Session::get('error'))
                        < class="alert alert-danger">
                            {{ $messageError }}
                </div>
                @endif
            </div>

            </div>
            <div class="row">
                <div class="col">

                    @foreach ($dataIzin as $d)
                        <ul class="listview image-listview">
                            <li>
                                <div class="item">
                                    <div class="in">
                                        <div>
                                            <b>{{ date('d-m-Y', strtoTime($d->tgl_izin)) }} ({{ $d->status=="s"?"sakit" : ($d->status == "i" ? " izin" : "penugasan" )}})</b>
                                             <br>
                                            <small class="text-muted">{{$d->keterangan}} </small>
                                        </div>

                                        @if($d->status_approved == 0)
                                        <span class="badge bg-warning">waiting</span>
                                        @elseif ($d->status_approved == 1)
                                        <span class="badge bg-success">Approved</span>
                                        @elseif ($d->status_approved == 2)
                                        <span class="badge bg-danger">Rejected</span>
                                            
                                        @endif
    
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
            <div class="fab-button bottom-right" style=" margin-bottom: 70px">
                <a href="/presensi/buatIzin" class="fab"><ion-icon name="add-outline"></ion-icon></a>
            </div>
        @endsection
