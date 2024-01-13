@extends('layouts.admin.tabler')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::get('warning'))
                            <div class="alert alert-warning">
                                {{ Session::get('warning') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="#" class="btn btn-primary" id="btnAdd">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M16 19h6" />
                                <path d="M19 16v6" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                            </svg>
                            Tambah Data
                        </a>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <form action="/tni_al" method="GET">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <input type="text" class="text form-control" id="nrp" name="nrp"
                                            placeholder="Cari NRP" value="{{ Request('nrp') }}">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id= "nama_prajurit" name="nama_prajurit"
                                            placeholder="Nama Prajurit" value="{{ Request('nama_prajurit') }}">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <select name="nama_kot" id="nama_kot" class="form-select">
                                            <option value="">Kotama</option>
                                            @foreach ($kotama as $d)
                                                <option {{ Request('nama_kot') == $d->kode_kot ? 'selected' : '' }}
                                                    value="{{ $d->kode_kot }}">
                                                    {{ $d->nama_kot }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-search" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                <path d="M21 21l-6 -6" />
                                            </svg>
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <table class="table table-border">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NRP</th>
                                    <th>NAMA</th>
                                    <th>PANGKAT</th>
                                    <th>JABATAN</th>
                                    <th>NO HP</th>
                                    <th>FOTO</th>
                                    <th>DEPARTEMEN</th>
                                    <th>ROLL</th>
                                    <th>KOTAMA</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tni_al as $d)
                                    @php
                                        $path = Storage::url('uploads/tni_al/' . $d->foto);
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration + $tni_al->firstItem() - 1 }} </td>
                                        <td>{{ $d->nrp }} </td>
                                        <td>{{ $d->nama_lengkap }} </td>
                                        <td>{{ $d->pangkat }} </td>
                                        <td>{{ $d->jabatan }} </td>
                                        <td>{{ $d->no_hp }} </td>
                                        <td>
                                            @if (empty($d->foto))
                                                <img src="{{ asset('assets/img/nophoto.png.png') }}" class="avatar"
                                                    alt="">
                                            @else
                                                <img src="{{ url($path) }}" class="avatar" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $d->nama_dept }} </td>
                                        <td>{{ $d->nama_roll }} </td>
                                        <td>{{ strtoupper($d->nama_kot) }} </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="edit btn btn-primary" nrp = "{{ $d->nrp }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-edit" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path
                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                </a>
                                                {{-- setjamkerja --}}
                                                <a href="/konfigurasi/{{$d->nrp}}/setjamkerja" class="btn btn-success" style="margin-left: 20px">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-settings" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                    </svg>
                                                </a>

                                                <form action="/tni_al/{{ $d->nrp }}/delete" method="POST"
                                                    style="margin-left: 20px">
                                                    @csrf

                                                    <a class="btn btn-danger delete-confirm">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-trash" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </a>
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $tni_al->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    </div>

    {{-- modal input --}}
    <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Prajurit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/tni_al/store" method="POST" id="frmtni_al" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-123"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 10l2 -2v8" />
                                        <path
                                            d="M9 8h3a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h3" />
                                        <path
                                            d="M17 8h2.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-1.5h1.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-2.5" />
                                    </svg>
                                </span>
                                <input type="text" value="" class="form-control" name="nrp" id="nrp"
                                    placeholder="NRP">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>
                                    </span>
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" value=""
                                        class="form-control" placeholder="Masukan Nama">
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrow-badge-down" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M17 13v-6l-5 4l-5 -4v6l5 4z" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" name="pangkat" class="form-control"
                                        id="pangkat" placeholder="Pangkat">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-user-scan" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 9a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
                                            <path d="M4 16v2a2 2 0 0 0 2 2h2" />
                                            <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                                            <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
                                            <path d="M8 16a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" name="jabatan" class="form-control"
                                        id="jabatan" placeholder="Jabatan">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12">
                                    <select name="kode_dept" class="form-select" id="kode_dept">
                                        <option value="">Departemen</option>
                                        @foreach ($departemen as $d)
                                            <option {{ Request('kode_dept') == $d->kode_dept ? 'selected' : '' }}
                                                value="{{ $d->kode_dept }}">
                                                {{ $d->nama_dept }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12">
                                    <select name="kode_kot" id="kode_kot" class="form-select">
                                        <option value="">Kotama</option>
                                        @foreach ($kotama as $d)
                                            <option {{ Request('kode_kot') == $d->kode_kot ? 'selected' : '' }}
                                                value="{{ $d->kode_kot }}">
                                                {{ strtoupper($d->nama_kot) }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12">
                                    <select name="kode_roll" id="kode_roll" class="form-select">
                                        <option value="">Roll</option>
                                        @foreach ($roll as $d)
                                            <option {{ Request('kode_roll') == $d->kode_roll ? 'selected' : '' }}
                                                value="{{ $d->kode_roll }}">
                                                {{ $d->nama_roll }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="no_hp" name="no_hp"
                                        class="form-control" placeholder="No Handphone">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12">
                                    <input type="file" name="foto" name="foto" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-send" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 14l11 -11" />
                                                <path
                                                    d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                                            </svg>
                                            Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Prajurit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadEditForm">

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $("#btnAdd").click(function() {
                $('#modal-simple').modal('show')
            });

            $(".edit").click(function() {
                var nrp = $(this).attr('nrp');
                $.ajax({
                    type: 'POST',
                    url: '/tni_al/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        nrp: nrp
                    },
                    success: function(respond) {
                        $("#loadEditForm").html(respond);
                    }
                });
                $("#modal-edit").modal("show")
            });

            $(".delete-confirm").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: "Apakah Anda yakin Data ini akan di Hapus?",
                    text: "Jika Ya maka Data  akan terhapus Permanen!!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    form.submit();
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Data Berhasil di Hapus',
                            'success'
                        )
                    }
                })
            });

            $("#frmtni_al").submit(function() {
                var nrp = $("frmtni_al").find("#nrp").val();
                var nama_lengkap = $("#nama_lengkap").val();
                var pangkat = $("#pangkat").val();
                var jabatan = $("#jabatan").val();
                var no_hp = $("#no_hp").val();
                var kode_dept = $("#kode_dept").val();
                var kode_roll = $("#kode_roll").val();
                var kode_kot = $("frmtni_al").find("#kode_kot").val();

                if (nrp == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'NRP Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Cool'
                    }).then((result) => {
                        $("#nrp").focus();
                    })
                    return false;
                } else if (nama_lengkap == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Nama Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Cool'
                    }).then((result) => {
                        $("#nama_lengkap").focus();
                    })
                    return false;
                } else if (pangkat == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'pangkat Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Cool'
                    }).then((result) => {
                        $("#pangkat").focus();
                    })
                    return false;
                } else if (jabatan == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Jabatan belum Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Cool'
                    }).then((result) => {
                        $("#jabatan").focus();
                    })
                    return false;
                } else if (no_hp == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Jabatan belum Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Cool'
                    }).then((result) => {
                        $("#no_hp").focus();
                    })
                    return false;
                } else if (kode_dep == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Departemen belum Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Cool'
                    }).then((result) => {
                        $("#departemen").focus();
                    })
                    return false;
                } else if (kode_kot == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'kotama belum Dipilih',
                        icon: 'warning',
                        confirmButtonText: 'Cool'
                    }).then((result) => {
                        $("#kode_kot").focus();
                    })
                    return false;
                } else if (kode_roll == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Roll belum Dipilih',
                        icon: 'warning',
                        confirmButtonText: 'Cool'
                    }).then((result) => {
                        $("#kode_roll").focus();
                    })
                    return false;
                }
            })

        });
    </script>
@endpush
