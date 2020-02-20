@extends('master.master')

@section('page-title', 'Home')

@section('title','Home')

@section('script')
@endsection

@section('header-content')
  <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
      <div class="header-body">
      </div>
    </div>
  </div>
@endsection

@section('body-content')
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header bg-transparent">
          <h3 class="mb-0 text-center">SPP</h3>
        </div>
        <div class="card-body">
          <h1 style="text-align: center;">Selamat Datang @if(Auth::guard('siswa')->check()){{Auth::user()->nama}}@else{{Auth::user()->nama_petugas}}@endif !!!</h1>
          <ol>
              @if(Auth::user()->level == "admin")
                  <li>Melihat data user</li>
                  <li>Menambah dan melihat data kategori</li>
                  <li>Menambah dan melihat data mata pelajaran</li>
                  <li>Menambah dan melihat data sub mata pelajaran</li>
              @endif
          </ol>
        </div>
      </div>
    </div>
  </div>
@endsection
