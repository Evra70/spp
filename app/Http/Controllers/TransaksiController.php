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

    public function prosesBatalPembayaranSpp($id_pembayaran,$id_siswa){
        $pembayaran =Pembayaran::find($id_pembayaran);
        $pembayaran->id_petugas = -1;
        $pembayaran->status = "N";
        $pembayaran->tgl_bayar = "00000000";
        $pembayaran->save();
            Alert()->success("Pembayaran Berhasil di Batalkan !","Sukses")->autoclose(2000);
            return redirect("/proses/$id_siswa/formPembayaran");
    }

    public function prosesPembayaranSpp($id_pembayaran,$id_siswa)
    {
        $pembayaran =Pembayaran::find($id_pembayaran);
        $pembayaran->id_petugas = Auth::id();
        $pembayaran->status = "Y";
        $pembayaran->tgl_bayar = date("Ymd");
        $pembayaran->save();
            Alert()->success("Pembayaran Berhasil di Lakukan !","Sukses")->autoclose(2000);
            return redirect("/proses/$id_siswa/formPembayaran");

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

        $pembayaran = DB::table('t_pembayaran')
                        ->leftJoin("t_petugas","t_pembayaran.id_petugas","t_petugas.id_petugas")
                        ->where("t_pembayaran.nisn",$siswa->nisn)
                        ->select('t_pembayaran.*','t_petugas.nama_petugas')
                        ->get();

        return view('formPembayaran',['siswa' => $siswa,'pembayaran'=>$pembayaran]);
    }

}
