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

class TransaksiController extends Controller
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
    public function prosesPembayaranSpp(Request $r)
    {
        $pembayaran = new Pembayaran();
        $pembayaran->id_petugas = Auth::id();
        $pembayaran->nisn = $r->nisn;
        $pembayaran->tgl_bayar = Date("Ymd");
        $pembayaran->bulan_bayar = $r->bulan;
        $pembayaran->tahun_bayar = date("Y");
        $pembayaran->id_spp = $r->id_spp;
        $pembayaran->nominal = $r->nominal;
        $pembayaran->save();
            Alert()->success("Pembayaran Berhasil di Lakukan !","Sukses")->autoclose(2000);
            return redirect("/proses/$r->id_siswa/formPembayaran");

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

    public function formPembayaran($id_siswa)
    {
        $siswa = DB::table('t_siswa')
                    ->join('t_kelas','t_siswa.id_kelas','t_kelas.id_kelas')
                    ->join('t_spp','t_siswa.id_spp','t_spp.id_spp')
                    ->where('t_siswa.id_siswa',$id_siswa)
                    ->first();

        $mon = [
            "01"=> "Januari", "05"=>"Mei", "09"=>"September",
            "02"=> "Februari", "06"=>"Juni", "10"=>"Oktober",
            "03"=> "Maret", "07"=>"Juli", "11"=>"November",
            "04"=> "April", "08"=>"Agustus", "12"=>"Desember"
        ];

        $pembayaran = DB::table('t_pembayaran')
                        ->join("t_petugas","t_pembayaran.id_petugas","t_petugas.id_petugas")
                        ->where("t_pembayaran.nisn",$siswa->nisn)
                        ->select('t_pembayaran.*','t_petugas.nama_petugas')
                        ->get();

        $bulanPembayaran = [];
        foreach ($pembayaran as $p){
            array_push($bulanPembayaran,$p->bulan_bayar);
        }

        $bulan =[];
        for($i=-1;$i<11;$i++){
           $date = date('m',strtotime("+$i month","20200501"));
           array_push($bulan,$mon[$date]);

        }

        $bulan = array_diff($bulan,$bulanPembayaran);

        return view('formPembayaran',['siswa' => $siswa,'bulan'=>$bulan,'pembayaran'=>$pembayaran]);
    }

}
