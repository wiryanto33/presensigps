<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
            font-size: 20px;
        }

        .datatabel {
            margin-top: 20px;
        }

        .datatabel td {
            padding: 3px;
        }

        .tabelpresensi {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;

        }

        .tabelpresensi tr th {
            border: 1px solid #090000;
            padding: 8px;
            background-color: #d3cece;

        }

        .tabelpresensi tr td {
            border: 1px solid #090000;
            padding: 5px;


        }

        .foto {
            width: 50px;
            height: 40px;
            align-content: center;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

    <?php
    function selisih($jam_masuk, $jam_keluar)
    {
        [$h, $m, $s] = explode(':', $jam_masuk);
        $dtAwal = mktime($h, $m, $s, '1', '1', '1');
        [$h, $m, $s] = explode(':', $jam_keluar);
        $dtAkhir = mktime($h, $m, $s, '1', '1', '1');
        $dtSelisih = $dtAkhir - $dtAwal;
        $totalmenit = $dtSelisih / 60;
        $jam = explode('.', $totalmenit / 60);
        $sisamenit = $totalmenit / 60 - $jam[0];
        $sisamenit2 = $sisamenit * 60;
        $jml_jam = $jam[0];
        return $jml_jam . ':' . round($sisamenit2);
    }
    
    ?>

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        <table style="width: 100%">
            <tr>
                <td>
                    <img src="{{ asset('assets/img/tni-al.png') }}" width="80" height="80" alt="">
                </td>
                <td>
                    <h2>LAPORAN PRESENSI PRAJURIT <br>
                        TENTARA NASIONAL INDONESIA ANGKATAN LAUT
                        <br>
                        PERIODE {{ $namaBulan[$bulan] }} {{ $tahun }}
                    </h2>
                </td>
            </tr>
        </table>
        <table class="datatabel">
            <tr>
                <td rowspan="7">
                    @php
                        $path = Storage::url('uploads/tni_al/' . $tni_al->foto);
                    @endphp
                    <img src="{{ url($path) }}" alt="" width="120px" height="150px">
                </td>
            </tr>
            <tr>
                <td>NAMA</td>
                <td>:</td>
                <td> {{ strtoupper($tni_al->nama_lengkap) }}</td>
            </tr>
            <tr>
                <td>PANGKAT</td>
                <td>:</td>
                <td> {{ strtoupper($tni_al->pangkat) }}</td>
            </tr>
            <tr>
                <td>DEPARTEMEN</td>
                <td>:</td>
                <td> {{ strtoupper($tni_al->nama_dept) }}</td>
            </tr>
            <tr>
                <td>NRP</td>
                <td>:</td>
                <td> {{ strtoupper($tni_al->nrp) }}</td>
            </tr>
            <tr>
                <td>JABATAN</td>
                <td>:</td>
                <td> {{ strtoupper($tni_al->jabatan) }}</td>
            </tr>
            <tr>
                <td>NO HP</td>
                <td>:</td>
                <td> {{ strtoupper($tni_al->no_hp) }}</td>
            </tr>
        </table>
        <table class="tabelpresensi">
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Foto Masuk</th>
                <th>Jam Pulang</th>
                <th>Foto Pulang</th>
                <th>Keterangan</th>
                <th>Jml Jam</th>
            </tr>
            @foreach ($presensi as $d)
                @php
                    $path_in = Storage::url('uploads/absensi/' . $d->foto_in);
                    $path_out = Storage::url('uploads/absensi/' . $d->foto_out);
                    $jamterlambat = selisih('07:00:00', $d->jam_in);
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</td>
                    <td>{{ $d->jam_in }} </td>
                    <td><img src="{{ url($path_in) }}" alt="" class="foto"></td>
                    <td>{{ $d->jam_out != null ? $d->jam_out : 'Belum Absen' }} </td>
                    <td>
                        @if ($d->foto_out != null)
                            <img src="{{ url($path_out) }}" alt="" class="foto">
                        @else
                            <img src="{{ asset('assets/img/nophoto.png.png') }}" alt="" width="50px"
                                height="50px">
                        @endif
                    </td>
                    <td>
                        @if ($d->jam_in > '07.00')
                            Terlambat {{ $jamterlambat }}
                        @else
                            Tepat Waktu
                        @endif
                    </td>
                    <td>
                        @if ($d->jam_out != null)
                            @php
                                $jmljamkerja = selisih($d->jam_in, $d->jam_out);
                            @endphp
                        @else
                            @php
                                $jmljamkerja = 0;
                            @endphp
                        @endif
                        {{ $jmljamkerja }};
                    </td>
                </tr>
            @endforeach

        </table>

        <table width = "100%" style="margin-top: 10px" >
            <tr>
                <td colspan="2" style="text-align: right">Surabaya {{date('d-m-Y')}} </td>
            </tr>
            <tr>
                <td style="text-align: center" height= "70">
                    Taufik<br>
                    Kolonel Laut (P) NRP 113672/P

                </td>

                <td style="text-align: center" >
                    Yudhi<br>
                    Letkol Laut (P) NRP 115643/P

                </td>
            </tr>
        </table>

        <!-- Write HTML just like a web page -->
        <article></article>

    </section>

</body>

</html>
