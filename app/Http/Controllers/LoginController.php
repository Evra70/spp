<?php

namespace App\Http\Controllers;

use App\Petugas;
use App\Siswa;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginPetugas(Request $request){
        $this->validate($request,[
            'username' => 'required|min:5',
            'password' => 'required|min:5'
        ]);
        $username = $request->username;
        $password = md5($request->password);

        $petugas = Petugas::where('username',$username)->where('password',$password)->first();
        if($petugas){
            $level=$petugas->level;
            Auth::guard("$level")->LoginUsingId($petugas->id_petugas);
            alert()->success('Login Berhasil !',"Berhasil")->autoclose(2000);
            return redirect("/$level");
        }else{
            alert()->error('Username atau Password Salah!',"Login Gagal")->autoclose(2000);
            return redirect()->back();
        }
    }

    public function loginSiswa(Request $request){
        $this->validate($request,[
            'nis_nisn' => 'required|min:5|numeric'
        ]);
        $nisNisn = $request->nis_nisn;

        $siswa = Siswa::where('nisn',$nisNisn)->orWhere('nis',$nisNisn)->first();

        if($siswa){
            $level="siswa";
            Auth::guard("$level")->LoginUsingId($siswa->id_siswa);
            alert()->success('Login Berhasil !',"Berhasil")->autoclose(2000);
            return redirect("/$level");
        }else{
            alert()->error('NIS / NISN Salah!',"Login Gagal")->autoclose(2000);
            return redirect()->back();
        }
    }

    public function logout(){
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            return redirect('/');
        }else if(Auth::guard('petugas')->check()){
            Auth::guard('petugas')->logout();
            return redirect('/');
        }else if(Auth::guard('siswa')->check()){
            Auth::guard('siswa')->logout();
            return redirect('/');
        }
    }

}
