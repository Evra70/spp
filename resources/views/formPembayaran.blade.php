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
                            
                        </tr>
                    </table>
                    <hr>
                    @php $no=1; @endphp
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Petugas</th>
                            <th scope="col">Tanggal Bayar</th>
                            <th scope="col">Bulan Bayar</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $bayar)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>@if($bayar->nama_petugas == null) --NONE-- @else{{$bayar->nama_petugas}}@endif</td>
                                    <td>@if($bayar->tgl_bayar == "00000000") --NONE-- @else{{date("d-m-Y",strtotime($bayar->tgl_bayar))}}@endif</td>
                                    <td>{{$bayar->bulan_bayar}} {{$bayar->tahun_bayar}}</td>
                                    <td>Rp.{{number_format($bayar->nominal,2,',','.')}}</td>
                                    <td>
                                        @if($bayar->status == "Y")
                                            <a style='color:white;padding:3px;' class="btn-success">LUNAS</a>
                                        @else
                                            <a style='color:white;padding:3px;' class="btn-danger">BELUM LUNAS</a>
                                        @endif
                                    </td>
                                    <td>
                                    @if($bayar->status != "Y")
                                        <a class="btn btn-success" href="/proses/{{$bayar->id_pembayaran}}/{{$siswa->id_siswa}}/pembayaran">Bayar</a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$bayar->id_pembayaran}}">
                                            Ubah
                                        </button>
                                    @else
                                        <a class="btn btn-danger" href="/proses/{{$bayar->id_pembayaran}}/{{$siswa->id_siswa}}/batalPembayaran">Batal</a>
                                    @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="exampleModalCenter{{$bayar->id_pembayaran}}" style="z-index: 9999991;" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Pembayaran</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/proses/editPembayaranSiswa" method="post">
                                                <div class="modal-body">
                                                    {{csrf_field()}}
                                                    <div class="pl-lg-4">
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-email">Nominal</label>
                                                                    <input type="hidden" name="id_pembayaran" value="{{$bayar->id_pembayaran}}">
                                                                    <input type="text" id="input-fullname" autocomplete="off"
                                                                           class="form-control form-control-alternative" value="{{$bayar->nominal}}" placeholder="EX: 150000"  name="nominal">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
