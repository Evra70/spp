@extends('master.master')

@section('page-title', 'Pembayaran SPP')

@section('title','Pembayaran SPP')

@section('script')
@endsection

@section('header-content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body" style="margin-bottom: -60px;">
            </div>
        </div>
    </div>
@endsection


@section('body-content')
    <div class="row mt-5">
        <div class="col">
            <div class="row">
                <div class="col-2">
                    <select class="form-control form-control-alternative" id="kelas">
                        <option value="">--Kelas--</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                <div class="col-2">
                    <select class="form-control form-control-alternative" id="jurusan">
                        <option value="">--Jurusan--</option>
                        <option value="RPL">RPL</option>
                        <option value="MM">MM</option>
                        <option value="TKRO">TKRO</option>
                        <option value="TB">TB</option>
                        <option value="BKP">BKP</option>
                    </select>
                </div>
                <div class="col-2">
                    <button class="btn btn-info" id="search">Search</button>
                </div>
            </div>
            <br>
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Daftar Siswa</h3>
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
                        @php $no=1; @endphp
                        <tbody id="siswa_list">
                        @foreach($siswaList as $siswa)
                                <tr>
                                    <th scope="row">{{$no++}}</th>
                                    <td>{{$siswa->nisn}}</td>
                                    <td>{{$siswa->nama}}</td>
                                    <td>{{$siswa->nama_kelas}} - {{$siswa->kompetensi_keahlian}}</td>
                                    <td class="text-right">
                                        @if(Auth::guard('admin')->check())
                                            <a class="btn btn-success" href="/proses/{{$siswa->id_siswa}}/formPembayaran">Bayar</a>
                                        @endif
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
@section('script-js')
    <script>
        $(document).ready(function () {
            $('#search').click(function () {
                search_table($('#kelas').val()+" - "+$('#jurusan').val());
            });

            function search_table(value) {
                $('#siswa_list tr ').each(function () {
                    var found = 'false';
                    $(this).each(function () {
                        if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){
                            found = 'true';
                        }
                    });


                    if (found == 'true'){
                        $(this).show();
                    }else {
                        $(this).hide();
                    }
                });
            }
        });
    </script>
@endsection
