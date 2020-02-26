@extends('master.master')

@section('page-title', 'Daftar Kelas')

@section('title','Daftar Kelas')

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
                    <h3 class="mb-0">Table Kelas</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Kelas</th>
                            <th scope="col">Kompetensi Keahlian</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no=1; @endphp
                        @foreach($kelasList as $kelas)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <td>{{$kelas->nama_kelas}}</td>
                                <td>{{$kelas->kompetensi_keahlian}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            . . .
                                        </a>
                                        @if(Auth::guard('admin')->check())
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="/mapel/{{$kelas->id_siswa}}/delete">Delete</a>
                                                <a class="dropdown-item" href="/menu/editMapelForm/{{$kelas->id_siswa}}">Edit</a>
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
