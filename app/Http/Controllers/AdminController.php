<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Patients;
use App\Models\Rekammedis;
use PDF;

class AdminController extends Controller
{
    public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
	}
    public function index(){
        $rekammedis= Rekammedis::orderBy('created_at')->paginate(10);
        $jumlahpasien = Patients::count();
        // dd(date("Y-m-d"));
        $pasienhariini = Rekammedis::whereDate('created_at',date("Y-m-d"))->count();
        $pasien = Patients::get();
        // dd($pasienhariini);
        return view('beranda',['pasien'=>$pasien,'rekammedis'=>$rekammedis,'jumlahpasien'=>$jumlahpasien,'pasienhariini'=>$pasienhariini]);

        // return view('beranda');
    }
    public function datapasien(){
        $pasien = Patients::orderBy('nama','desc')->paginate(10);
        return view('datapasien',['pasien'=>$pasien]);
    }
    public function tambahdatapasien(Request $request){
        // dd($request);

        $request->validate(
            [
                'NIK' => 'required',
                'nama' => 'required',
                'no_BPJS' => 'required',
                'alamat' => 'required',
                'tanggal_lahir' => 'required',
                'gol_darah' => 'required',

            ]
        );
        $cekdata= DB::table('patients')->where('NIK','=',$request->NIK)->orwhere('no_BPJS','=',$request->no_BPJS)->first();

        if($cekdata){
            return redirect('/datapasien')->with('failed', 'NIK atau no BPJS sudah terdaftar');
        }else{
            $pasien = new Patients;
            $pasien->NIK = $request->NIK;
            $pasien->nama = $request->nama;
            $pasien->no_BPJS = $request->no_BPJS;
            $pasien->alamat = $request->alamat;
            $pasien->tgl_lahir = $request->tanggal_lahir;
            $pasien->gol_darah = $request->gol_darah;

            $pasien->save();

            if($pasien){
                return redirect('/datapasien')->with('success', 'Data pasien berhasil disimpan');
            }else{
                return redirect('/datapasien')->with('failed', 'Terjadi kesalahan saat menyimpan data pasien');
            }

        }
    }
    public function hapusdatapasien(Request $request, $NIK){
        // dd($request);
        $cekdata = Rekammedis::where('no_BPJS',$request->no_BPJS)->first();
        if($cekdata){
            return redirect('/datapasien')->with('failed', 'Terdapat rekam medis yang terdaftar');
        }else{
            $delete = DB::table('patients')->where('NIK','=',$NIK)->delete();
            if($delete){
                return redirect('/datapasien')->with('success', 'Data pasien berhasil dihapus');
            }else{
                return redirect('/datapasien')->with('failed', 'Terjadi kesalahan saat penghapusan data pasien');
            }
        }

    }

    public function editdatapasien($NIK){

        $pasien = Patients::where('NIK',$NIK)->first();
        // dd($nelayan);
        return view('/editpasien',['pasien'=>$pasien]);
    }

    public function proseditdatapasien(Request $request){
        // dd($request->NIK);
        $request->validate(
            [
                'NIK' => 'required',
                'nama' => 'required',
                'no_BPJS' => 'required',
                'alamat' => 'required',
                'tanggal_lahir' => 'required',
                'gol_darah' => 'required',

            ]
        );
            try{
                $pasien = Patients::where('NIK',$request->NIK)->first();
                $pasien->NIK = $request->NIK;
                $pasien->nama = $request->nama;
                $pasien->no_BPJS = $request->no_BPJS;
                $pasien->alamat = $request->alamat;
                $pasien->tgl_lahir = $request->tanggal_lahir;
                $pasien->gol_darah = $request->gol_darah;
                $pasien->update();
                if($pasien){
                    return redirect('/datapasien')->with('success', 'Data pasien berhasil diupdate');
                }else{
                    return redirect('/datapasien')->with('failed', 'Terjadi kesalahan saat update data pasien');
                }
            }catch(Exception $e){
                return redirect('/datapasien')->with('failed', 'NIK atau No BPJS sudah digunakan');
            }

    }
    public function simpanrekammedis(Request $request){
        // dd($request);
        $pasien = Patients::where('no_BPJS',$request->no_BPJS)->first();
        if($pasien){
            // localStorage.setItem("nama", "Agus");
            // $request->session()->put('data',$pasien);

            // return redirect('/')->with('success', 'Data Ditemukan');
            $rekammedis = new Rekammedis;
            $rekammedis->no_BPJS = $request->no_BPJS;
            $rekammedis->poliklinik = $request->poli;
            $rekammedis->keluhan = $request->keluhan;

            $rekammedis->save();
            return redirect('/')->with('success', 'Data Berhasil disimpan');
        }else{
            return redirect('/')->with('failed', 'BPJS Belum terdaftar');
        }
        // dd($pasien);
    }
    public function editrekammedis(Request $request){
        // dd($request);

        // localStorage.setItem("nama", "Agus");
        // $request->session()->put('data',$pasien);

        // return redirect('/')->with('success', 'Data Ditemukan');
        // $pasien = Patients::where('NIK',$request->NIK)->first();
        $rekammedis = Rekammedis::findOrfail($request->id);
        // $rekammedis->no_BPJS = $request->no_BPJS;
        $rekammedis->poliklinik = $request->poli;
        $rekammedis->keluhan = $request->keluhan;

        $rekammedis->update();
        if($rekammedis){
            return redirect('/')->with('success', 'Data Berhasil diupdate');
        }else{
            return redirect('/')->with('failed', 'Terjadi kesalahan saat update data');
        }
        // dd($pasien);
    }
    public function caripasien(Request $request){
        // dd(count($request));
        $allpasien = Patients::get();
        // dd($allpasien);

        if($request){
            $old_request['no_BPJS']=$request->no_BPJS;
            // dd($old_request);
            $rekammedis = Rekammedis::where('no_BPJS',$request->no_BPJS)->paginate(10);
            if($rekammedis){
                return view('caripasien',['pasien'=>$rekammedis, 'allpasien'=>$allpasien, 'old_request'=>$old_request])->with('success', 'Data berhasil didapat');
            }else{
                return view('caripasien',['pasien'=>$rekammedis, 'allpasien'=>$allpasien, 'old_request'=>$old_request])->with('failed', 'Data tidak ditemukan');
            }
        }
        return view('caripasien',['allpasien'=>$allpasien]);
        // dd($rekammedis);
    }
    public function printReport(Request $request){
        $allpasien = Patients::get();
        // dd($request);
        $old_request['tahun']=$request->tahun;

        $val = Validator::make(
            $request->all(),
            [
                'no_BPJS' => 'required',
            ]
        );
        // dd($request);
        if ($val->fails() || $request->no_BPJS=="null") {
            // dd('salah');
            $rekammedis = Rekammedis::where('no_BPJS',$request->no_BPJS)->paginate(10);
            $old_request['no_BPJS']=$request->no_BPJS;
            return view('caripasien',['pasien'=>$rekammedis, 'allpasien'=>$allpasien, 'old_request'=>$old_request])->with('failed', 'Data tidak ditemukan');
        }
        // dd($rekammedis);
        $rekammedis = Rekammedis::where('no_BPJS',$request->no_BPJS)->get();

        $pdf = PDF::loadview('printReport',['pasien'=>$rekammedis])->setPaper('A4','potrait');
            // return $pdf->stream();
            $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                    'ssl' => [
                        'allow_self_signed'=> TRUE,
                        'verify_peer' => FALSE,
                        'verify_peer_name' => FALSE,
                    ]
                ])
            );
            return $pdf->download('laporanPasien.pdf');
    }
    public function hapusrekammedis($id){
        $delete = DB::table('rekammedis')->where('id','=',$id)->delete();
        if($delete){
            return redirect('/')->with('success', 'Data berhasil dihapus');
        }else{
            return redirect('/')->with('failed', 'Terjadi kesalahan saat penghapusan data ');
        }
    }

}
