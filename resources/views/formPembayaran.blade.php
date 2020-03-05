@extends('master.master')

@section('page-title', 'Pembayaran Spp Siswa')

@section('title',"Pembayaran Spp $siswa->nama")

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
                    <h3 class="mb-0">Data Siswa</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <tr class="thead-light">
                            <th width="10%"><b>Nama</b></th>
                            <td width="20%">: {{$siswa->nama}}</td>
                            <th width="10%"><b>Kelas</b></th>
                            <td width="20%">: {{$siswa->nama_kelas}} - {{$siswa->kompetensi_keahlian}}</td>
                        </tr>
                        <tr class="thead-light">
                            <th width="10%"><b>NISN</b></th>
                            <td width="20%">: {{$siswa->nisn}}</td>
                            <th width="10%"><b>Tahun Ajaran</b></th>
                            <td width="20%">: {{$siswa->tahun}}</td>
                        </tr>
                        <tr class="thead-light">
                            <th width="10%"><b>NIS</b></th>
                            <td width="20%">: {{$siswa->nis}}</td>
                            <th width="10%"><b>Nominal</b></th>
                            <td width="20%">: Rp.{{number_format($siswa->nominal,2,',','.')}}</td>
                        </tr>
                        <tr class="thead-light">
                            <form>
                                <td colspan="2"><b>Pembayaran Spp</b></td>
                                <td colspan="2">: {{$siswa->nis}}</td>
                            </form>
                        </tr>
                    </table>
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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
