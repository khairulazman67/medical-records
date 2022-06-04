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
                <h1 class="font-bold text-white text-xl">Data Pasien </h1>
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
            
            

            <div class="my-5 pb-5 flex justify-center mx-auto">
                <div class="flex flex-row mx-16">
                    <div class="mr-5 w-1/4">
                        <div class="text-xl font-bold">
                            Tambah Data Pasien
                        </div>
                        <form action="/tambahdatapasien" method="post">
                            @csrf
                            {{-- <input class="w-full" type="date" value="2017-06-01"> --}}
                            <div class="relative z-0 w-full my-6 group">
                                <input type="text" name="nama"
                                    class="@error('nama') is-invalid @enderror block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Nama</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="NIK"
                                    class="@error('NIK') is-invalid @enderror block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    NIK</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="no_BPJS"
                                    class="@error('no_BPJS') is-invalid @enderror block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    No BPJS</label>
                            </div>

                            <div class="relative z-0 w-full mb-6 group">
                                <label for="countries" class="block mb-2 text-sm  text-gray-500 ">
                                    Golongan Darah
                                </label>
                                <select name="gol_darah" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required
                                >
                                    <option value="" selected>Pilih Golongan Darah</option>
                                    <option value="O-">O-</option>
                                    <option value="O+">O+</option>
                                    <option value="A-">A-</option>
                                    <option value="A+">A+</option>
                                    <option value="B-">B-</option>
                                    <option value="B+">B+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="AB+">AB+</option>
                                </select>
                                @error('id_boat')
                                    <span class="text-red my-10" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="relative z-0 w-full mb-6 group">
                                <input type="date" name="tanggal_lahir"
                                    class="@error('tanggal_lahir') is-invalid @enderror block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Tanggal Lahir</label>
                            </div>
                            
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="alamat"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                    placeholder=" " required />
                                <label
                                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Alamat</label>
                            </div>
                            
                            <button type="submit"
                                class="bg-emerald-500 text-white hover:bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                Simpan Data
                            </button>
                        </form>
                    </div>
                    <div class="w-3/4">
                        <div class="border-b border-gray-200  shadow overflow-x-scroll">
                            <table class="divide-y  divide-gray-300 ">
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
                                        <th class="px-3 py-2">
                                            Tanggal Lahir
                                        </th>
                                        <th class="px-3 w-14 py-2">
                                            Alamat
                                        </th>
                                        <th class="px-3 py-2">
                                            Aksi
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
                                                {{$dat->nama}}
                                            </td>
                                            <td class="px-3 py-4">
                                                {{$dat->NIK}}
                                            </td>
                                            <td class="px-3 py-4">
                                                {{$dat->no_BPJS}}
                                            </td>
                                            <td class="px-3 py-4">
                                                {{$dat->gol_darah}}
                                            </td>
                                            <td class="px-3 py-4">
                                                {{$dat->tgl_lahir}}
                                            </td>
                                            <td class="px-3 max-w-14 py-4">
                                                <p>{{$dat->alamat}}</p>
                                            </td>
                                            
                                            <td class="flex px-3 py-4">
                                                <form action="{{url('pasien/'.$dat->NIK)}}" method="get">
                                                    @csrf
                                                    <button
                                                        class="px-6 py-1 text-sm text-white bg-yellow-400 hover:bg-yellow-500 rounded-lg">Edit</button>
                                                </form>
                                                
                                                {{-- </form> --}}
                                                <form action="{{url('pasien/'.$dat->NIK)}}" method="post"
                                                    onsubmit="return confirm('Apakah anda ingin melanjutkan penghapusan data?')">
                                                    <input type="hidden" name="no_BPJS" value="{{$dat->no_BPJS}}">
                                                    @method('delete')
                                                    @csrf
                                                    <button
                                                        class="px-6 py-1 text-sm text-white bg-red-700 ml-2 hover:bg-red-800 rounded-lg">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $pasien->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
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
