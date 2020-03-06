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

    public function editPembayaranSiswa(Request $r)
    {
        $this->validate($r,[
            'nominal' => 'required|numeric',
        ]);
        $bayar=Pembayaran::find($r->id_pembayaran);
        $bayar->nominal = $r->nominal;
        $bayar->save();
                Alert()->success("Pembayaran Berhasil di Ubah !","Sukses")->autoclose(1500);
                return redirect()->back();

    }

    public function prosesDeletePembayaran($id_pembayaran)
    {
        $bayar = Pembayaran::find($id_pembayaran);
        $bayar->delete();

        Alert()->success("Transaksi Berhasil di Hapus !","Sukses")->autoclose(1500);
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
        $bulan =array();
        $awal="2020-05-01";
        $date="";
        for($i=-1;$i<11;$i++){
           $date = date('m',strtotime("+$i month","20200501"));
           array_push($bulan,$mon[$date]);
        }
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
