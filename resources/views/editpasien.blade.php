@extends('../layouts/admin_layout')
@section('title', 'Edit Data Pasien')
@section('content')

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
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
        <div class="w-full h-auto shadow-xl shadow-gray-400 mt-5 rounded-xl pb-7">
            <div class="flex flex-row bg-secondary-900 rounded-t-xl px-10 py-3">
                <a href="{{ url()->previous() }}" class="text-lg text-primary-800 hover:text-gray-900"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
                <h1 class="ml-3 font-bold text-white text-xl">Edit Data Pasien</h1>
            </div>
            <div class="px-24 flex flex-row justify-center">
                
                <div class="w-80 mt-10">
                    <form action="/editpasien" method="post">
                        @csrf
                        <input type="hidden" name="NIK" value="{{$pasien?$pasien->NIK:''}}">
                        <input type="hidden" name="no_BPJS" value="{{$pasien?$pasien->no_BPJS:''}}">
                        {{-- <input class="w-full" type="date" value="2017-06-01"> --}}
                        <div class="relative z-0 w-full my-6 group">
                            <input type="text" name="nama" value="{{$pasien?$pasien->nama:''}}"
                                class="@error('nama') is-invalid @enderror block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                placeholder=" " required />
                            <label
                                class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Nama</label>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="text" name="NIK" value="{{$pasien?$pasien->NIK:''}}"
                                class=" bg-gray-100 rounded-lg  block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                placeholder=" " disabled/>
                            <label
                                class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                NIK</label>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="text" name="no_BPJS" value="{{$pasien?$pasien->no_BPJS:''}}"
                                class=" bg-gray-100 rounded-lg  block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                placeholder=" " disabled />
                            <label
                                class="mb-5 peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                No BPJS</label>
                        </div>

                        <div class="relative z-0 w-full mb-6 group">
                            <label for="countries" class="block mb-2 text-sm  text-gray-500 ">
                                Golongan Darah
                            </label>
                            <select name="gol_darah" id="countries"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required
                            >
                                <option value="{{$pasien?$pasien->gol_darah:''}}" selected>{{$pasien?$pasien->gol_darah:''}}</option>
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
                            <input type="date" name="tanggal_lahir" value="{{$pasien?$pasien->tgl_lahir:''}}"
                                class="@error('tanggal_lahir') is-invalid @enderror block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-900 peer"
                                placeholder=" " required />
                            <label
                                class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0  peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Tanggal Lahir</label>
                        </div>
                        
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="text" name="alamat" value="{{$pasien?$pasien->alamat:''}}"
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
                <div class="inset-y-0 -right-2">
                    <img src="{{asset('img/ILUS.png') }}" alt="" class="mt-5 ml-20 w-[550px]">
                </div> 
            </div>
        </div>
    </div>
@endsection

