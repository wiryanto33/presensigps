@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Set Jam Kerja
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <tr>
                            <th>NRP</th>
                            <td>{{ $tni_al->nrp }}</td>
                        </tr>
                        <tr>
                            <th>NAMA LENGKAP</th>
                            <td>{{ $tni_al->nama_lengkap }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <form action="/konfigurasi/storeSetJamKerja" method="post">
                    @csrf
                    <input type="hidden" name="nrp" value="{{ $tni_al->nrp }}">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>HARI</th>
                                <th>JAM KERJA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Senin
                                    <input type="hidden" name="hari[]" value="Senin">
                                </td>
                                <td>
                                    <select name="kode_jam_kerja[]" id="kode_jam_kerja">
                                        <option value="">PILIH JAM KERJA</option>
                                        @foreach ($jam_kerja as $d)
                                            <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                                        @endforeach
                                    </select>

                                </td>
                            </tr>
                            <tr>
                                <td>Selasa
                                    <input type="hidden" name="hari[]" value="Selasa">
                                </td>
                                <td>
                                    <select name="kode_jam_kerja[]" id="kode_jam_kerja">
                                        <option value="">PILIH JAM KERJA</option>
                                        @foreach ($jam_kerja as $d)
                                            <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Rabu
                                    <input type="hidden" name="hari[]" value="Rabu">
                                </td>
                                <td>
                                    <select name="kode_jam_kerja[]" id="kode_jam_kerja">
                                        <option value="">PILIH JAM KERJA</option>
                                        @foreach ($jam_kerja as $d)
                                            <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Kamis
                                    <input type="hidden" name="hari[]" value="Kamis">
                                </td>
                                <td>
                                    <select name="kode_jam_kerja[]" id="kode_jam_kerja">
                                        <option value="">PILIH JAM KERJA</option>
                                        @foreach ($jam_kerja as $d)
                                            <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Jumat
                                    <input type="hidden" name="hari[]" value="Jumat">
                                </td>
                                <td>
                                    <select name="kode_jam_kerja[]" id="kode_jam_kerja">
                                        <option value="">PILIH JAM KERJA</option>
                                        @foreach ($jam_kerja as $d)
                                            <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary w-100 " type="submit">Simpan</button>
            </div>
            </form>

            <div class="col-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="6">MASTER JAM KERJA</th>
                        </tr>
                        <tr>
                            <th>KODE</th>
                            <th>NAMA</th>
                            <th>AWAL MASUK</th>
                            <th>JAM MASUK</th>
                            <th>AKHIR MASUK</th>
                            <th>JAM PULANG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jam_kerja as $d)
                            <tr>
                                <td>{{ $d->kode_jam_kerja }}</td>
                                <td>{{ $d->nama_jam_kerja }}</td>
                                <td>{{ $d->awal_jam_masuk }}</td>
                                <td>{{ $d->jam_masuk }}</td>
                                <td>{{ $d->akhir_jam_masuk }}</td>
                                <td>{{ $d->jam_pulang }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
