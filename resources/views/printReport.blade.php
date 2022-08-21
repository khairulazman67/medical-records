<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    <title>Document</title>
    <style>
        .col1{
            width: 5%;
            text-align: center;
        }
        .paddingcol{
            padding-right: 20px;
            padding-left:10px;
        }
        .tbody{
            font-size: 18px
        }
        thead{
            font-size : 20px
        }
        table {
            margin-top : 10px;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php
        function bulan_indo($inp){
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );

            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun
            return $bulan[ (int)$inp ];
        }
        function tgl_indo($tanggal){
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);

            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun
            return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
        }
        function hari($hari){
            switch($hari){
                case 'Sun':
                    $hari_ini = "Minggu";
                break;
                case 'Mon':
                    $hari_ini = "Senin";
                break;
                case 'Tue':
                    $hari_ini = "Selasa";
                break;
                case 'Wed':
                    $hari_ini = "Rabu";
                break;
                case 'Thu':
                    $hari_ini = "Kamis";
                break;
                case 'Fri':
                    $hari_ini = "Jumat";
                break;
                case 'Sat':
                    $hari_ini = "Sabtu";
                break;
                default:
                    $hari_ini = "Tidak di ketahui";
                break;
            }
            return  $hari_ini ;
        }
    ?>
    <center>
        <h2 style="margin-block-end:0em">Laporan Rekam Medis Puskesmas Nibong</h2>
    </center>
    <table >
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$pasien[0]->patients->nama}}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{$pasien[0]->patients->NIK}}</td>
        </tr>
        <tr>
            <td>No BPJS</td>
            <td>:</td>
            <td>{{$pasien[0]->no_BPJS}}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>T{{$pasien[0]->patients->alamat}}</td>
        </tr>
        <tr>
            <td>Golongan Darah</td>
            <td>:</td>
            <td>{{$pasien[0]->patients->gol_darah}}</td>
        </tr>
    </table>

    <center>
    {{-- {{dd($data)}} --}}
    <table border="1" style="margin-left:auto; margin-right:auto;">
        <thead style="background-color:black; color:white; padding-top:15px; padding-bottom:15px">
            <tr >
                <th class="col1">No</th>
                <th>Tanggal Berobat</th>
                <th>Poli</th>
                <th>Keluhan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pasien as $i=>$dat)
                <tr>
                    <td class="col1">{{$i+1}}</td>
                    <td class="paddingcol">{{hari($dat->created_at->format('D'))}}, {{tgl_indo($dat->created_at->format('Y-m-d'))}}</td>
                    <td class="paddingcol">{{$dat->poliklinik}}</td>
                    <td class="paddingcol">{{$dat->keluhan}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </center>
</body>
</html>
