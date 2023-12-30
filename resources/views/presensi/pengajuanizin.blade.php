@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Data Izin
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="row">
            <div class="container-xl ">
                <div class="row">
                    <div class="col-12">
                        <form action="/presensi/pengajuanizin" method="GET" autocomplete="off">
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-calendar-filled" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M16 2a1 1 0 0 1 .993 .883l.007 .117v1h1a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h1v-1a1 1 0 0 1 1.993 -.117l.007 .117v1h6v-1a1 1 0 0 1 1 -1zm3 7h-14v9.625c0 .705 .386 1.286 .883 1.366l.117 .009h12c.513 0 .936 -.53 .993 -1.215l.007 -.16v-9.625z"
                                                    stroke-width="0" fill="currentColor" />
                                                <path
                                                    d="M12 12a1 1 0 0 1 .993 .883l.007 .117v3a1 1 0 0 1 -1.993 .117l-.007 -.117v-2a1 1 0 0 1 -.117 -1.993l.117 -.007h1z"
                                                    stroke-width="0" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <input type="text" value="{{Request('dari')}}" class="form-control" name="dari"
                                            id="dari" placeholder="Dari">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-calendar-filled" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M16 2a1 1 0 0 1 .993 .883l.007 .117v1h1a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h1v-1a1 1 0 0 1 1.993 -.117l.007 .117v1h6v-1a1 1 0 0 1 1 -1zm3 7h-14v9.625c0 .705 .386 1.286 .883 1.366l.117 .009h12c.513 0 .936 -.53 .993 -1.215l.007 -.16v-9.625z"
                                                    stroke-width="0" fill="currentColor" />
                                                <path
                                                    d="M12 12a1 1 0 0 1 .993 .883l.007 .117v3a1 1 0 0 1 -1.993 .117l-.007 -.117v-2a1 1 0 0 1 -.117 -1.993l.117 -.007h1z"
                                                    stroke-width="0" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <input type="text" value="{{Request('sampai')}}" class="form-control" name="sampai"
                                            id="sampai" placeholder="Sampai">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                                <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M15 8l2 0" />
                                                <path d="M15 12l2 0" />
                                                <path d="M7 16l10 0" />
                                            </svg>
                                        </span>
                                        <input type="text" value="{{Request('nrp')}}" class="form-control" name="nrp"
                                            id="nrp" placeholder="Nrp">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-users" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                            </svg>
                                        </span>
                                        <input type="text" value="{{Request('nama_lengkap')}}" class="form-control" name="nama_lengkap"
                                            id="nama_lengkap" placeholder="Nama Prajurit">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <select name="status_approved" id="status_approved" class="form-select">
                                            <option value="">Pilih Status</option>
                                            <option value="0"{{Request('status_approved') === '0' ? 'selected' : ""}}>Status Menunggu</option>
                                            <option value="1" {{Request('status_approved') == 1? 'selected' : ""}}>Status Disetujui</option>
                                            <option value="2" {{Request('status_approved') == 2? 'selected' : ""}}>Status Ditolak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-search" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                <path d="M21 21l-6 -6" />
                                            </svg>
                                            Cari Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama</th>
                                    <th>pangkat</th>
                                    <th>NRP</th>
                                    <th>Tanggal Izin</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Setatus Approved</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuanizin as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }} </td>
                                        <td>{{ $d->nama_lengkap }} </td>
                                        <td>{{ $d->pangkat }} </td>
                                        <td>{{ $d->nrp }} </td>
                                        <td>{{ date('d-m-Y', strtotime($d->tgl_izin)) }} </td>
                                        <td>{{ $d->status == 'i' ? 'Izin' : 'Sakit' }} </td>
                                        <td>{{ $d->keterangan }} </td>
                                        <td>
                                            @if ($d->status_approved == 1)
                                                <span class="bg bg-success rounded-1">Disetujui</span>
                                            @elseif($d->status_approved == 2)
                                                <span class="bg bg-danger rounded-1">Ditolak</span>
                                            @else
                                                <span class="bg bg-warning rounded-1">Waiting</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($d->status_approved == 0)
                                                <a href="#" class="btn btn-primary " id="approve"
                                                    id_izin ="{{ $d->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-direction-sign" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M3.32 12.774l7.906 7.905c.427 .428 1.12 .428 1.548 0l7.905 -7.905a1.095 1.095 0 0 0 0 -1.548l-7.905 -7.905a1.095 1.095 0 0 0 -1.548 0l-7.905 7.905a1.095 1.095 0 0 0 0 1.548z" />
                                                        <path d="M8 12h7.5" />
                                                        <path d="M12 8.5l3.5 3.5l-3.5 3.5" />
                                                    </svg>
                                                </a>
                                            @else
                                                <a href="/presensi/{{ $d->id }}/batalkanizin"
                                                    class="btn btn-danger ">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-square-rounded-x"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 10l4 4m0 -4l-4 4" />
                                                        <path
                                                            d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                                    </svg>
                                                    Batalkan
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pengajuanizin->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-pengajuanizin" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Persetujuan Izin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/presensi/approveizin" method="POST">
                        @csrf
                        <input type="hidden" id="id_approve" name="id_approve">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="status_approved" id="status_approved" class="form-select">
                                        <option value="1">Disetujui</option>
                                        <option value="2">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 ">
                                <div class="form-group ">
                                    <button class="btn btn-primary w-100" type="submit">
                                        Send
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-send-2" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4.698 4.034l16.302 7.966l-16.302 7.966a.503 .503 0 0 1 -.546 -.124a.555 .555 0 0 1 -.12 -.568l2.468 -7.274l-2.468 -7.274a.555 .555 0 0 1 .12 -.568a.503 .503 0 0 1 .546 -.124z" />
                                            <path d="M6.5 12h14.5" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $("#approve").click(function(e) {
                e.preventDefault();
                var id_izin = $(this).attr("id_izin");
                $("#id_approve").val(id_izin);
                $("#modal-pengajuanizin").modal('show');
            });

            $("#dari, #sampai").datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endpush
