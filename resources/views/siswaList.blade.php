@extends('master.master')

@section('page-title', 'Daftar Siswa')

@section('title','Daftar Siswa')

@section('script')
@endsection

@section('header-content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body" style="margin-bottom: -60px;">
                <!-- Card stats -->
            </div>
        </div>
    </div>
@endsection


@section('body-content')
    <div class="row mt-5">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Table Siswa</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Kelas</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no=1; @endphp
                        @foreach($siswaList as $siswa)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <td>{{$siswa->nisn}}</td>
                                <td>{{$siswa->nama}}</td>
                                <td>{{$siswa->nama_kelas}} - {{$siswa->kompetensi_keahlian}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            . . .
                                        </a>
                                        @if(Auth::guard('admin')->check())
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="/proses/{{$siswa->id_siswa}}/deleteSiswa">Delete</a>
                                                <a class="dropdown-item" href="/proses/{{$siswa->id_siswa}}/formEditSiswa">Edit</a>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
