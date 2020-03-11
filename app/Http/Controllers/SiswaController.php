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
use App\TahunAjaran;

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
            'no_telp' => 'required|min:1|max:13',
        ]);

        $findSiswa = Siswa::where('nisn',$request->nisn)->orWhere("nis",$request->nis)->first();
        if ($findSiswa){
            Alert()->warning("Nisn: $request->nisn \nNis: $request->nis \nTelah Digunakan !","Maaf")->autoclose(2000);
            return redirect()->back();
        }else{

            $mon = [
                "01"=> "Januari", "05"=>"Mei", "09"=>"September",
                "02"=> "Februari", "06"=>"Juni", "10"=>"Oktober",
                "03"=> "Maret", "07"=>"Juli", "11"=>"November",
                "04"=> "April", "08"=>"Agustus", "12"=>"Desember"
                ];
            $tahun = substr($request->tahun,0,4);
            $awal="$tahun-07-01";

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

            for ($i=0; $i < 12 ; $i++) { 
                $tempo = date('m',strtotime("+$i month",strtotime($awal)));
                $tahun = date('Y',strtotime("+$i month",strtotime($awal)));
                $bulan=$mon[$tempo];

                $pembayaran = new Pembayaran();
                $pembayaran->nisn = $siswa->nisn;
                $pembayaran->tgl_bayar = "00000000";
                $pembayaran->bulan_bayar = $bulan;
                $pembayaran->tahun_bayar = $tahun;
                $pembayaran->id_spp = $spp->id_spp;
                $pembayaran->nominal = $spp->nominal;
                $pembayaran->save();
            }

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
        DB::table('t_pembayaran')->where('nisn',$siswa->nisn)->delete();
        $spp = Spp::find($siswa->id_spp);
        $spp->delete();
        $siswa->delete();

        Alert()->success("Data Siswa Berhasil di Hapus !","Sukses")->autoclose(2000);
        return redirect()->back();
    }

    public function formEditSiswa($id_siswa)
    {
        $siswa = DB::table('t_siswa')
                    ->join('t_kelas','t_siswa.id_kelas','t_kelas.id_kelas')
                    ->join('t_spp','t_siswa.id_spp','t_spp.id_spp')
                    ->where('t_siswa.id_siswa',$id_siswa)
                    ->first();
        $kelasList = Kelas::all();
        return view('formEditSiswa',['kelasList' => $kelasList,'siswa' => $siswa]);
    }

}
