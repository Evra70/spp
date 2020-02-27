<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Petugas;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Crypt;

class PetugasController extends Controller
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
    public function prosesAddPetugas(Request $request)
    {
        $this->validate($request,[
            'nama_petugas' => 'required|min:4',
            'username' => 'required|min:5',
            'level' => 'required|min:4',
            'password' => 'required|min:5',
            'confirm_password' => 'required|min:5',
        ]);

        $findPetugas = Petugas::where('username',$request->username)->first();
        if ($findPetugas){
            Alert()->warning("Username: $request->username Telah Digunakan !","Maaf")->autoclose(2000);
            return redirect()->back();
        }else if ($request->password != $request->confirm_password){
            Alert()->warning("Password Tidak Sinkron !","Maaf")->autoclose(2000);
            return redirect()->back();
        }else{
            $petugas = new Petugas();
            $petugas->nama_petugas = $request->nama_petugas;
            $petugas->username = $request->username;
            $petugas->level = $request->level;
            $petugas->password = base64_encode($request->password);
            $petugas->save();
            Alert()->success("User Berhasil di Tambahkan !","Sukses")->autoclose(2000);
            return redirect('/menu/petugasList');
        }

    }

    public function prosesEditPetugas(Request $request)
    {
        $this->validate($request,[
            'nama_petugas' => 'required|min:4',
            'username' => 'required|min:5',
            'level' => 'required|min:4',
            'password' => 'required|min:5',
        ]);
        $findPetugas = Petugas::where('username',$request->username)->first();
        $petugas = Petugas::find($request->id_petugas);

        if (isset($request->check)){

            if ($findPetugas->username == $request->username && $findPetugas->id_petugas != $request->id_petugas){

                Alert()->warning("Username: $request->username Telah Digunakan !","Maaf")->autoclose(2000);
                return redirect()->back();

            }else if ($request->password != $request->confirm_password){

                Alert()->warning("Password Tidak Sinkron !","Maaf")->autoclose(2000);
                return redirect()->back();

            }else{

                $petugas->nama_petugas = $request->nama_petugas;
                $petugas->username = $request->username;
                $petugas->level = $request->level;
                $petugas->password = base64_encode($request->password);
                $petugas->save();
                Alert()->success("User Berhasil di Ubah !","Sukses")->autoclose(2000);
                return redirect('/menu/petugasList');

            }
        }else{

            if ($findPetugas->username == $request->username && $findPetugas->id_petugas != $request->id_petugas){

                Alert()->warning("Username: $request->username Telah Digunakan !","Maaf")->autoclose(2000);
                return redirect()->back();

            }else{

                $petugas->nama_petugas = $request->nama_petugas;
                $petugas->username = $request->username;
                $petugas->level = $request->level;
                $petugas->save();
                Alert()->success("User Berhasil di Ubah !","Sukses")->autoclose(2000);
                return redirect('/menu/petugasList');

            }
        }


    }

    public function deletePetugas($id_petugas)
    {
        $petugas = Petugas::find($id_petugas);
        $petugas->delete();

        Alert()->success("Data Petugas Berhasil di Hapus !","Sukses")->autoclose(2000);
        return redirect()->back();
    }

    public function formEditPetugas($id_petugas)
    {
        $petugas = Petugas::find($id_petugas);
        $petugas->password = base64_decode($petugas->password);
        return view("formEditPetugas",["petugas" => $petugas]);
    }

}
