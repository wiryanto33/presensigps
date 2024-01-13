@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Konfigurasi Jam Kerja
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
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
                                    <a href="#" class="btn btn-primary" id="btnAddJK">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-clock-plus" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M20.984 12.535a9 9 0 1 0 -8.468 8.45" />
                                            <path d="M16 19h6" />
                                            <path d="M19 16v6" />
                                            <path d="M12 7v5l3 3" />
                                        </svg>
                                        Tambah Data Jam Kerja
                                    </a>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12">
                                    <table class="table table-border">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>KODE JK</th>
                                                <th>NAMA JK</th>
                                                <th>AWAL JAM MASUK</th>
                                                <th>JAM MASUK</th>
                                                <th>AKHIR JAM MASUK</th>
                                                <th>JAM PULANG</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        @foreach ($jam_kerja as $d)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->kode_jam_kerja }}</td>
                                                <td>{{ $d->nama_jam_kerja }}</td>
                                                <td>{{ $d->awal_jam_masuk }}</td>
                                                <td>{{ $d->jam_masuk }}</td>
                                                <td>{{ $d->akhir_jam_masuk }}</td>
                                                <td>{{ $d->jam_pulang }}</td>
                                                <td>
                                                    {{-- edit --}}
                                                    <div class="btn-group">
                                                        <a href="#" class="edit btn btn-primary"
                                                            kode_jam_kerja = "{{ $d->kode_jam_kerja }}">
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

                                                        {{-- delete --}}
                                                        <form action="/konfigurasi/{{ $d->kode_jam_kerja }}/delete"
                                                            method="POST" style="margin-left: 20px">
                                                            @csrf

                                                            <a class="btn btn-danger delete-confirm">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="icon icon-tabler icon-tabler-trash"
                                                                    width="24" height="24" viewBox="0 0 24 24"
                                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path d="M4 7l16 0" />
                                                                    <path d="M10 11l0 6" />
                                                                    <path d="M14 11l0 6" />
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                </svg>
                                                            </a>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal input --}}
    <div class="modal modal-blur fade" id="modal-inputjk" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">TAMBAH JAM KERJA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/konfigurasi/storejamkerja" method="POST" id="frmJK">
                        @csrf

                        {{-- tambah kode jam kerja --}}
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                </span>
                                <input type="text" value="" class="form-control" name="kode_jam_kerja"
                                    id="kode_jam_kerja" placeholder="KODE JAM KERJA">
                            </div>
                        </div>

                        {{-- tambah nama JAM KERJA --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                    </span>
                                    <input type="text" id="nama_jam_kerja" name="nama_jam_kerja" value=""
                                        class="form-control" placeholder="NAMA JAM KERJA">
                                </div>
                            </div>

                            {{-- tambah awal jam masuk --}}
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M12 10l0 3l2 0" />
                                            <path d="M7 4l-2.75 2" />
                                            <path d="M17 4l2.75 2" />
                                        </svg>
                                    </span>
                                    <input type="text" id="awal_jam_masuk" name="awal_jam_masuk" value=""
                                        class="form-control" placeholder="AWAL JAM MASUK">
                                </div>
                            </div>

                            {{-- tambah jam masuk --}}
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M12 10l0 3l2 0" />
                                            <path d="M7 4l-2.75 2" />
                                            <path d="M17 4l2.75 2" />
                                        </svg>
                                    </span>
                                    <input type="text" id="jam_masuk" name="jam_masuk" value=""
                                        class="form-control" placeholder="JAM MASUK">
                                </div>
                            </div>

                            {{-- tambah akhir jam masuk --}}
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M12 10l0 3l2 0" />
                                            <path d="M7 4l-2.75 2" />
                                            <path d="M17 4l2.75 2" />
                                        </svg>
                                    </span>
                                    <input type="text" id="akhir_jam_masuk" name="akhir_jam_masuk" value=""
                                        class="form-control" placeholder="AKHIR JAM MASUK">
                                </div>
                            </div>

                            {{-- tambah jam pulang --}}
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M12 10l0 3l2 0" />
                                            <path d="M7 4l-2.75 2" />
                                            <path d="M17 4l2.75 2" />
                                        </svg>
                                    </span>
                                    <input type="text" id="jam_pulang" name="jam_pulang" value=""
                                        class="form-control" placeholder="JAM PULANG">
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
    <div class="modal modal-blur fade" id="modal-editJK" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jam Kerja</h5>
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
            $("#btnAddJK").click(function() {
                $('#modal-inputjk').modal('show')
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

            
            $("#frmJK").submit(function() {
                var kode_jam_kerja = $("#kode_jam_kerja").val();
                var nama_jam_kerja = $("#nama_jam_kerja").val();
                var awal_jam_masuk = $("#awal_jam_masuk").val();
                var jam_masuk = $("#jam_masuk").val();
                var akhir_jam_masuk = $("#akhir_jam_masuk").val();
                var jam_pulang = $("#jam_pulang").val();


                if (kode_jam_kerja == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Kode Jam Kerja Harus Di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#kode_jam_kerja").focus();
                    });
                    return false;
                } else if (nama_jam_kerja == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Nama Jam Kerja Harus Di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#nama_jam_kerja").focus();
                    });
                    return false;
                } else if (awal_jam_masuk == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Awal Jam Masuk Harus Di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#awal_jam_masuk").focus();
                    });
                    return false;
                } else if (jam_masuk == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Jam Masuk Absen Harus Di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#jam_masuk ").focus();
                    });
                    return false;
                } else if (akhir_jam_masuk == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Akhir Jam Masuk Absen Harus Di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#akhir_jam_masuk").focus();
                    });
                    return false;
                } else if (jam_pulang == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Jam Pulang Absen Harus Di isi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#jam_pulang").focus();
                    });
                    return false;
                }
            });
            $(".edit").click(function() {
                var kode_jam_kerja = $(this).attr('kode_jam_kerja');
                $.ajax({
                    type: 'POST',
                    url: '/konfigurasi/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode_jam_kerja: kode_jam_kerja
                    },
                    success: function(respond) {
                        $("#loadEditForm").html(respond);
                    }
                });
                $("#modal-editJK").modal("show")
            });

        });
    </script>
@endpush
