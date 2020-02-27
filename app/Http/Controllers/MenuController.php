<?php

namespace App\Http\Controllers;

use App\District;
use App\Kelas;
use App\Mapel;
use App\Petugas;
use App\Province;
use App\Regency;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
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
    public function index()
    {
        return view('welcome');
    }

    public function home()
    {
        return view('home');
    }

    public function petugasList()
    {
        $petugasList = Petugas::all();
        return view('petugasList',["petugasList" => $petugasList]);
    }

    public function kelasList()
    {
        $kelasList = Kelas::all();
        return view('kelasList',["kelasList" => $kelasList]);
    }

    public function formAddPetugas()
    {
        return view('formAddPetugas');
    }

    public function formAddSiswa()
    {
        $kelasList = Kelas::all();
        return view('formAddSiswa',['kelasList' => $kelasList]);
    }

    public function siswaList()
    {
        $siswaList = DB::table('t_siswa')
                            ->join('t_kelas','t_siswa.id_kelas','t_kelas.id_kelas')
                            ->select('t_siswa.*','t_kelas.nama_kelas','t_kelas.kompetensi_keahlian')
                            ->get();
        return view('siswaList',["siswaList" => $siswaList]);
    }

}
