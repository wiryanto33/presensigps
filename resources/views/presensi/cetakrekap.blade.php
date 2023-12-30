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
            font-size: 8px;

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

<body class="A4 landscape">

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
                    <h2>REKAP PRESENSI PRAJURIT <br>
                        TENTARA NASIONAL INDONESIA ANGKATAN LAUT
                        <br>
                        PERIODE {{ $namaBulan[$bulan] }} {{ $tahun }}
                    </h2>
                </td>
            </tr>
        </table>
        <table class="tabelpresensi">
            <tr>
                <th rowspan="2">NRP</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">pangkat</th>
                <th colspan="31">Tanggal</th>
                <th rowspan="2">TH</th>
                <th rowspan="2">TT</th>
            </tr>
            <tr>
                <?php
                for($i=1; $i<=31; $i++){
                    ?>
                <th>{{ $i }} </th>
                <?php
                }
                ?>

            </tr>

            @foreach ($rekap as $d)
                <tr>
                    <td>{{ $d->nrp }}</td>
                    <td>{{ $d->nama_lengkap }}</td>
                    <td>{{ $d->pangkat }}</td>

                    <?php
                    $totalhadir = 0;
                    $totalterlambat = 0;
                for($i=1; $i<=31; $i++){
                    $tgl ="tgl_".$i;
                               
                    if(empty($d->$tgl)){
                        $hadir = ['', ''];  
                        $totalhadir += 0; 
                    } else{
                        $hadir = explode("-", $d->$tgl);
                        $totalhadir += 1;

                        if($hadir[0] > "07:00:00"){
                            $totalterlambat +=1;
                        }
                    }
                    ?>
                    <td>
                        <span style="color: {{ $hadir[0] > '07:00:00' ? 'red' : ' ' }}">{{ $hadir[0] }} </span><br>
                        <span style="color: {{ $hadir[1] < '15:30:00' ? 'red' : ' ' }}">{{ $hadir[1] }} </span>
                    </td>
                    <?php
                }
                ?>
                    <td>{{ $totalhadir }} </td>
                    <td>{{ $totalterlambat }} </td>
                </tr>
            @endforeach

        </table>

        <table width = "100%" style="margin-top: 10px">
            <tr>
                <td></td>
                <td style="text-align: center">Surabaya {{ date('d-m-Y') }} </td>
            </tr>
            <tr>
                <td style="text-align: center" height= "70">
                    Taufik<br>
                    Kolonel Laut (P) NRP 113672/P

                </td>

                <td style="text-align: center">
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
