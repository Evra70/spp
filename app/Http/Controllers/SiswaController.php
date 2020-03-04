<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Mapel;
use App\Pembayaran;
use App\Siswa;
use App\Spp;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function prosesAddSiswa(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|min:4',
            'nisn' => 'required|min:8',
            'nis' => 'required|min:6',
            'tahun' => 'required',
            'kelas' => 'required',
            'nominal' => 'required|numeric',
            'alamat' => 'required|min:5',
            'no_telp' => 'required|numeric',
        ]);

        $findSiswa = Siswa::where('nisn',$request->nisn)->orWhere("nis",$request->nis)->first();
        if ($findSiswa){
            Alert()->warning("Nisn: $request->nisn \nNis: $request->nis \nTelah Digunakan !","Maaf")->autoclose(2000);
            return redirect()->back();
        }else{
            $spp = new Spp();
            $spp->tahun = $request->tahun;
            $spp->nominal = $request->nominal;
            $spp->save();

            $siswa = new Siswa();
            $siswa->nisn = $request->nisn;
            $siswa->nis = $request->nis;
            $siswa->nama = $request->nama;
            $siswa->no_telp = $request->no_telp;
            $siswa->alamat = $request->alamat;
            $siswa->id_kelas = $request->kelas;
            $siswa->id_spp = $spp->id_spp;
            $siswa->save();

            Alert()->success("Siswa Berhasil di Tambahkan !","Sukses")->autoclose(2000);
            return redirect('/menu/siswaList');

        }

    }

    public function prosesEditSiswa(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|min:4',
            'nisn' => 'required|min:8',
            'nis' => 'required|min:6',
            'tahun' => 'required',
            'kelas' => 'required',
            'nominal' => 'required|numeric',
            'alamat' => 'required|min:5',
            'no_telp' => 'required|numeric',
        ]);

        $findSiswa = Siswa::where('nisn',$request->nisn)->orWhere('nis',$request->nis)->get();
        $siswa = Siswa::find($request->id_siswa);
            if (count($findSiswa) > 1){
                Alert()->warning("NISN: $request->nisn \n NIS: $request->nis Telah Digunakan !","Maaf")->autoclose(2000);
                return redirect()->back();
            }else{

            $spp = Spp::find($siswa->id_spp);
            $spp->tahun = $request->tahun;
            $spp->nominal = $request->nominal;
            $spp->save();

            $siswa->nisn = $request->nisn;
            $siswa->nis = $request->nis;
            $siswa->nama = $request->nama;
            $siswa->no_telp = $request->no_telp;
            $siswa->alamat = $request->alamat;
            $siswa->id_kelas = $request->kelas;
            $siswa->id_spp = $spp->id_spp;
            $siswa->save();

                Alert()->success("Siswa Berhasil di Edit !","Sukses")->autoclose(2000);
                return redirect('/menu/siswaList');

            }

    }

    public function deleteSiswa($id_siswa)
    {
        $siswa = Siswa::find($id_siswa);
        $siswa->delete();

        Alert()->success("Data Siswa Berhasil di Hapus !","Sukses")->autoclose(2000);
        return redirect()->back();
    }

    public function formEditSiswa($id_siswa)
    {
        $siswa = DB::table('t_siswa')
                    ->join('t_kelas','t_siswa.id_kelas','t_kelas.id_kelas')
                    ->join('t_spp','t_siswa.id_spp','t_spp.id_spp')
                    ->first();
        $kelasList = Kelas::all();
        return view('formEditSiswa',['kelasList' => $kelasList,'siswa' => $siswa]);
    }

}
