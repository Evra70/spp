<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Siswa;
use App\Spp;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Crypt;

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
            'nama_siswa' => 'required|min:4',
            'username' => 'required|min:5',
            'level' => 'required|min:4',
            'password' => 'required|min:5',
        ]);
        $findSiswa = Siswa::where('username',$request->username)->first();
        $siswa = Siswa::find($request->id_siswa);

        if (isset($request->check)){

            if ($findSiswa->username == $request->username && $findSiswa->id_siswa != $request->id_siswa){

                Alert()->warning("Username: $request->username Telah Digunakan !","Maaf")->autoclose(2000);
                return redirect()->back();

            }else if ($request->password != $request->confirm_password){

                Alert()->warning("Password Tidak Sinkron !","Maaf")->autoclose(2000);
                return redirect()->back();

            }else{

                $siswa->nama_siswa = $request->nama_siswa;
                $siswa->username = $request->username;
                $siswa->level = $request->level;
                $siswa->password = base64_encode($request->password);
                $siswa->save();
                Alert()->success("User Berhasil di Ubah !","Sukses")->autoclose(2000);
                return redirect('/menu/siswaList');

            }
        }else{

            if ($findSiswa->username == $request->username && $findSiswa->id_siswa != $request->id_siswa){

                Alert()->warning("Username: $request->username Telah Digunakan !","Maaf")->autoclose(2000);
                return redirect()->back();

            }else{

                $siswa->nama_siswa = $request->nama_siswa;
                $siswa->username = $request->username;
                $siswa->level = $request->level;
                $siswa->save();
                Alert()->success("User Berhasil di Ubah !","Sukses")->autoclose(2000);
                return redirect('/menu/siswaList');

            }
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
        $siswa = Siswa::find($id_siswa);
        $siswa->password = base64_decode($siswa->password);
        return view("formEditSiswa",["siswa" => $siswa]);
    }

}
