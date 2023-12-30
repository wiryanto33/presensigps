@extends('layouts.presensi')
@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <style>
        .datepicker-modal {
            max-height: 440px !important;
        }

        .datepicker-date-display {
            background-color: #0f3a7f !important;
        }
    </style>
    <-!-- App Header-->
        <div class="appHeader bg-primary text-light">
            <div class="left">
                <a href="javascript:;" class="headerButton goBack">
                    <ion-icon name = "chevron-back-outline"></ion-icon>
                </a>
            </div>
            <div class="pageTitle">Form Izin</div>
            <div class="right"></div>
        </div>
        <-!--* App Header-->
        @endsection
        @section('content')
            <div class="row" style="margin-top: 70px">
                <div class="col">
                    <form method="POST" action="/presensi/storeIzin" id="formIzin">
                        @csrf
                        <div class="col">
                            <div class="form-group">
                                <input type="text" id="tgl_izin" name="tgl_izin" class="form-control datepicker"
                                    placeholder="Tanggal">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Izin/Sakit/Penugasan</option>
                                    <option value="i">Izin</option>
                                    <option value="s">Sakit</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>

                        {{-- untuk data dukung upload --}}

                        {{-- untuk data dukung upload end --}}

                        <div class="col" style="margin-bottom: 70px">
                            <div class="form-group">
                                <button class="btn btn-primary w-100"> Kirim </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endsection

        @push('myscript')
            <script>
                const calender = document.querySelector('.datepicker');
                M.Datepicker.init(calender, {
                    format: "yyyy-mm-dd"
                });

                $("#tgl_izin").change(function(e) {
                    var tgl_izin = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: '/presensi/cekpengajuanizin',
                        data: {
                            _token: "{{ csrf_token() }}",
                            tgl_izin: tgl_izin
                        },
                        cache: false,
                        success: function(respond) {
                            if (respond == 1) {
                                Swal.fire({
                                    title: 'Oops!',
                                    text: 'izin sudah ada',
                                    icon: 'warning',
                                }).then((result) => {
                                    $("#tgl_izin").val("");
                                });
                            }
                        }

                    });
                })



                $("#formIzin").submit(function() {
                    var tgl_izin = $("#tgl_izin").val();
                    var status = $("#status").val();
                    var keterangan = $("#keterangan").val();

                    if (tgl_izin == "") {
                        Swal.fire({
                            title: 'Oops!',
                            text: 'Tanggal Harus Diisi',
                            icon: 'warning',
                        });
                        return false;
                    } else if (status == "") {
                        Swal.fire({
                            title: 'Oops!',
                            text: 'Status Harus Diisi',
                            icon: 'warning',
                        });
                        return false;
                    } else if (keterangan == "") {
                        Swal.fire({
                            title: 'Oops!',
                            text: 'Keterangan Harus Diisi',
                            icon: 'warning',
                        });
                        return false;
                    }

                });
            </script>
        @endpush
