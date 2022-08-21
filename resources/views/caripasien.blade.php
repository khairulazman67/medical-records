@extends('../layouts/admin_layout')
@section('title', 'Detail Mahasiswa')
@section('content')

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
        integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });

    </script>
        <?php
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
    <div class="container mx-auto mb-10">
        <!-- tulisan atas -->
        <div class="w-full  relative">
            <div class="mt-4">
                <div class="flex justify-center text-white font-bold text-4xl bg-secondary-900 rounded-3xl  mb-5 py-3">
                    Sistem Pencatatan Rekam Medis Puskesmas Nibong
                </div>
            </div>
            <div class="bg-primary-700 h-2 "></div>
        </div>
        <!-- table -->

        <div class="w-full h-auto shadow-xl shadow-gray-400 mt-10 rounded-xl">
            <div class="bg-secondary-900 rounded-t-xl px-10 py-3">
                <h1 class="font-bold text-white text-xl">Data Riwayat Medis Pasien </h1>
            </div>
            {{-- Message --}}
            @if (session()->has('success'))
            <div class="flex justify-between mx-2 my-2 bg-green-600 text-white rounded-lg h-10 text-lg px-5">
                <p class="my-auto">{{session()->get('success')}}</p>
                <i class="my-auto hover:text-gray-600 fas fa-times alert-del"></i>
            </div>
            @elseif (session()->has('failed'))
            <div class="flex justify-between mx-2 my-2 bg-red-500 text-white rounded-lg h-10 text-lg px-5">
                <p class="my-auto">{{session()->get('failed')}}</p>
                <i class="my-auto hover:text-gray-600 fas fa-times alert-del"></i>
            </div>
            @endif

            @php
                // dd($allpasien)
            @endphp

            <div class="my-5 pb-5 flex justify-center mx-auto">
                <div class="flex flex-row mx-16">
                    <form action="{{url('/caripasien')}}" method="post">
                        @csrf
                        <label for="" class="font-bold text-xl">No BPJS Pasien : </label>
                        {{-- <input type="text" name="no_BPJS" class="rounded-xl"> --}}
                        <select required name="no_BPJS" class="rounded-xl" >
                            <label>Kelas :</label><br>
                            <option value="">-- Kode BPJS --</option>
                            {{-- <option value="{{$dat->no_BPJS}}">{{$dat->nama}} ({{$dat->no_BPJS}})</option> --}}
                            {{-- <option value="{{$old_request['no_BPJS']?$old_request['no_BPJS']:''}}" selected>{{$old_request['no_BPJS']?$old_request['no_BPJS']:'Pilih Kode BPJS'}}</option> --}}
                            @foreach ($allpasien as $i=>$dat)
                                <option value="{{$dat->no_BPJS}}">{{$dat->nama}} ({{$dat->no_BPJS}})</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-secondary-800 hover:bg-secondary-900 py-2 px-5 text-white rounded-xl font-bold"><i class="fa-solid fa-magnifying-glass "></i> Cari Pasien</button>
                    </form>
                    <form action="{{url('/printreport')}}" method="post">
                        @csrf
                        {{-- {{dd($old_request['tahun'])}} --}}
                        @if (!isset($old_request))
                            <?php
                                $old_request['no_BPJS']=null;
                            ?>
                        @endif
                        <input type="hidden" name="no_BPJS" value="{{$old_request['no_BPJS']}}">
                        <button type="submit" class="ml-2 bg-primary-700 hover:bg-primary-800 py-2 px-5 text-white rounded-xl font-bold"><i class="fa-solid fa-print"></i> Print Report</button>
                    </form>
                </div>
            </div>
            <div class="my-5 pb-5 flex justify-center">
                @if (count($pasien)>0)
                    <div class="flex flex-row px-5 w-full">
                        <table class="divide-y  divide-gray-300 overflow-x-scroll">
                            <thead class="bg-gray-900 text-white rounded-xl">
                                <tr>
                                    <th class="px-3 py-2 ">
                                        No
                                    </th>
                                    <th class="px-3 py-2">
                                        Nama
                                    </th>
                                    <th class="px-3 py-2">
                                        NIK
                                    </th>
                                    <th class="px-3 py-2">
                                        No BPJS
                                    </th>
                                    <th class="px-3 py-2 ">
                                        Golongan Darah
                                    </th>
                                    <th class="px-3 w-14 py-2">
                                        Alamat
                                    </th>
                                    <th class="px-3 py-2">
                                        Tanggal Berobat
                                    </th>
                                    <th class="px-3 py-2">
                                        Poli
                                    </th>
                                    <th class="px-3 py-2 w-44">
                                        Keluhan
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-300 text-black">
                                <?php $j = ($pasien->currentpage()-1)* $pasien->perpage() + 1;?>
                                @foreach ($pasien as $i=>$dat)
                                    <tr class="whitespace-nowrap">
                                        <td class=" py-4 text-center">
                                            {{$j++}}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{$dat->patients->nama}}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{$dat->patients->NIK}}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{$dat->no_BPJS}}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{$dat->patients->gol_darah}}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{$dat->patients->alamat}}
                                        </td>
                                        <td class="px-3 max-w-14 py-4">
                                            {{hari($dat->created_at->format('D'))}}, {{tgl_indo($dat->created_at->format('Y-m-d'))}}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{$dat->poliklinik}}
                                        </td>
                                        <td class="px-3 py-4 w-44">
                                            {{$dat->keluhan}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pasien->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-edit-backdrop"></div>
        <script type="text/javascript">
            function toggleModal(modalID) {
                document.getElementById(modalID).classList.toggle("hidden");
                document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
                document.getElementById(modalID).classList.toggle("flex");
                document.getElementById(modalID + "-backdrop").classList.toggle("flex");
            }

            var alert_del = document.querySelectorAll('.alert-del');
            alert_del.forEach((x) =>
                x.addEventListener('click', function () {
                    x.parentElement.classList.add('hidden');
                })
            );
        </script>
    </div>
    @endsection
