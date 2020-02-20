<?php

namespace App\Http\Controllers;

use App\District;
use App\Mapel;
use App\Province;
use App\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function dynamicDependent(Request $request)
    {
        $select = $request->select;
        $value = $request->value;
        $data=[];
        $init="";
        if($select == 'province'){
            $data = Regency::where('province_id',$value)->orderBy('name')->get();
            $init = "Kabupaten";
        }elseif ($select == 'regency'){
            $data = District::where('regency_id',$value)->orderBy('name')->get();
            $init = "Kecamatan";
        }

        $output ="<option value=''>--Pilih $init--</option>";
        foreach ($data as $row){
            $output .= "<option value='$row->id'>$row->name</option>";
        }
        echo $output;
    }

    public function getMapelListChange(Request $request)
    {
        $kategori_id = $request->kategori_id;
        $data=[];
        $init="";

            $data = Mapel::where('kategori_id',$kategori_id)->orderBy('nama_mapel')->get();

        $output ="<option value=''>--Pilih Mapel--</option>";
        foreach ($data as $row){
            $output .= "<option value='$row->mapel_id'>$row->nama_mapel</option>";
        }
        echo $output;
    }

    public function kursus()
    {
        $provinceList = Province::orderBy('name')->get();
        return view('kursus',['provinceList' => $provinceList]);
    }

    public function kontak()
    {
        $provinceList = Province::orderBy('name')->get();
        return view('kontak',['provinceList' => $provinceList]);
    }

    public function tentangKami()
    {
        $provinceList = Province::orderBy('name')->get();
        return view('tentang_kami',['provinceList' => $provinceList]);
    }

}
