<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Mapel;
use App\Spp;
use App\Siswa;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
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
    public function prosesAddKelas(Request $request)
    {
        $this->validate($request,[
            'nama_kelas' => 'required|min:1',
            'kompetensi_keahlian' => 'required|min:2',
        ]);

        $findKelas = Kelas::where('nama_kelas',$request->nama_kelas)->where("kompetensi_keahlian",$request->kompetensi_keahlian)->first();
        if ($findKelas){
            Alert()->warning("Kelas: $request->nama_kelas - $request->kompetensi_keahlian Telah Digunakan !","Maaf")->autoclose(2000);
            return redirect()->back();
        }else{
           $kelas = new Kelas();
           $kelas->nama_kelas = $request->nama_kelas;
           $kelas->kompetensi_keahlian=$request->kompetensi_keahlian;
           $kelas->save();

            Alert()->success("Kelas Berhasil di Tambahkan !","Sukses")->autoclose(2000);
            return redirect('/menu/kelasList');

        }

    }

    public function prosesEditKelas(Request $request)
    {
        $this->validate($request,[
            'nama_kelas' => 'required|min:1',
            'kompetensi_keahlian' => 'required|min:2',
        ]);

        $findKelas = Kelas::where('nama_kelas',$request->nama_kelas)->where('kompetensi_keahlian',$request->kompetensi_keahlian)->first();

            if (isset($findKelas) && ($findKelas->nama_kelas == $request->nama_kelas
                    && $findKelas->kompetensi_keahlian == $request->kompetensi_keahlian)
                    && $findKelas->id_kelas != $request->id_kelas){
                Alert()->warning("Kelas: $request->nama_kelas - $request->kompetensi_keahlian Telah Digunakan !","Maaf")->autoclose(2000);
                return redirect()->back();
            }else{


                $kelas = Kelas::find($request->id_kelas);
                $kelas->nama_kelas = $request->nama_kelas;
                $kelas->kompetensi_keahlian = $request->kompetensi_keahlian;
                $kelas->save();

                Alert()->success("Kelas Berhasil di Edit !","Sukses")->autoclose(2000);
                return redirect('/menu/kelasList');

            }

    }
    
    public function deleteKelas($id_kelas)
    {
        $kelas = Kelas::find($id_kelas);
        $kelas->delete();

        Alert()->success("Data Kelas Berhasil di Hapus !","Sukses")->autoclose(2000);
        return redirect()->back();
    }

    public function kenaikanKelas(Request $r)
    {
       
        foreach($r->check_id as $id){
            $siswa = Siswa::find($id);
            $siswa->id_kelas = $r->kelas_tujuan;
            $siswa->save();
            $spp = Spp::find($siswa->id_spp);
            $spp->tahun = $r->tahun;
            $spp->save();
        }
        Alert()->success("Siswa Berhasil Naik Kelas !","Sukses")->autoclose(2000);
        return redirect('/menu/siswaList');
    }

    public function formEditKelas($id_kelas)
    {
        $kelas = Kelas::find($id_kelas);
        return view('formEditKelas',['kelas' => $kelas]);
    }

}
