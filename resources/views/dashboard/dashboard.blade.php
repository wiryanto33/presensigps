@extends('layouts.presensi')

@section('content')
    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                @if (!empty(Auth::guard('tni_al')->user()->foto))
                    @php
                        $path = Storage::url('uploads/tni_al/' . Auth::guard('tni_al')->user()->foto);
                    @endphp
                    <img src="{{ url($path) }}" alt="avatar" class="imaged w64 rounded">
                @else
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                @endif
            </div>
            <div id="user-info">
                <h2 id="user-name">{{ Auth::guard('tni_al')->user()->nama_lengkap }}</h2>
                <span id="user-role">{{ Auth::guard('tni_al')->user()->jabatan }}</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/editProfile" class="text-primary" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/izin" class="danger" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Cuti</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/histori" class="warning" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="text-info" style="font-size: 40px;">
                                <ion-icon name="location"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            Lokasi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($presensiHariIni !== null)
                                        @php
                                            $path = Storage::url('uploads/absensi/' . $presensiHariIni->foto_in);
                                        @endphp
                                        <img src="{{ url($path) }}" alt="" class="imaged w64">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>{{ $presensiHariIni !== null ? $presensiHariIni->jam_in : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($presensiHariIni !== null && $presensiHariIni->jam_out !== null)
                                        @php
                                            $path = Storage::url('uploads/absensi/' . $presensiHariIni->foto_out);
                                        @endphp
                                        <img src="{{ url($path) }}" alt="" class="imaged w64">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>
                                        {{ $presensiHariIni !== null ? $presensiHariIni->jam_out : 'Belum Absen' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="rekappresensi">
            <h2 style="text-align: center">Rekap Presensi Bulan {{ $namaBulan[$bulanIni] }} Tahun {{ $tahunIni }} </h2>

            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 5px 5px; !important line-height:0.8">
                            <span class="badge bg-danger"
                                style="position: absolute; top:2px; right:5px; font-size:0.6rem; 
                            z-index:999">{{ $rekapPresensi->jumlahhadir }}</span>
                            <ion-icon name="accessibility" style="font-size: 1.6rem;" class="text-primary mb-1"></ion-icon>
                            <br>
                            <span style="font-weight: 500;">Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 5px 5px; !important line-height:0.8">
                            <span class="badge bg-danger"
                                style="position: absolute; top:2px; right:5px; font-size:0.6rem;   
                            z-index:999">{{$rekapIzin->jmlIzin != null? $rekapIzin->jmlIzin : 0}}
                            </span>
                            <ion-icon name="newspaper" style="font-size: 1.6rem;" class="text-success mb-1"></ion-icon>
                            <br>
                            <span style="font-weight: 500;">Izin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 5px 5px; !important line-height:0.8">
                            <span class="badge bg-danger"
                                style="position: absolute; top:2px; right:5px; font-size:0.6rem; z-index:999">
                                {{ $rekapIzin->jmlSakit != null? $rekapIzin->jmlSakit :0 }}</span>
                            <ion-icon name="medkit" style="font-size: 1.6rem;" class="text-danger mb-1"></ion-icon>
                            <br>
                            <span style="font-weight: 500;">Sakit </span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 5px 5px; !important line-height:0.8">
                            <span class="badge bg-danger"
                                style="position: absolute; top:2px; right:5px; font-size:0.6rem; z-index:999">
                                {{ $rekapPresensi->jumlahTerlambat !=null? $rekapPresensi->jumlahTerlambat :0 }}</span>

                            <ion-icon name="alarm" style="font-size: 1.6rem;" class="text-warning mb-1"></ion-icon>
                            <br>
                            <span style="font-weight: 500;">Terlambat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Leaderboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">

                    <ul class="listview image-listview">
                        @foreach ($historiBulanIni as $d)
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="finger-print-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>{{ date('d-m-Y', strtotime($d->tgl_presensi)) }} </div>
                                        <span class="badge badge-success">{{ $d->jam_in }} </span>
                                        <span
                                            class="badge badge-danger">{{ $presensiHariIni !== null && $d->jam_out !== null ? $d->jam_out : 'Belum Absen' }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($leaderBoard as $d)
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div><b>{{ $d->nama_lengkap }}</b> <br>
                                            <small class="text-muted">{{ $d->jabatan }}</small>
                                        </div>
                                        <span
                                            class="badge {{ $d->jam_in < '07:00' ? 'bg-success' : 'bg-danger' }}">{{ $d->jam_in }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
