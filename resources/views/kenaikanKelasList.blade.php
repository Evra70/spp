@extends('master.master')

@section('page-title', 'Kenaikan Kelas')

@section('title','Kenaikan Kelas')

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
                <div class="col-3">
                    <select class="form-control form-control-alternative" id="kelas_awal">
                        <option value="">--Pilih Kelas Awal--</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{$kelas->nama_kelas}} - {{$kelas->kompetensi_keahlian}}">{{$kelas->nama_kelas}} - {{$kelas->kompetensi_keahlian}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <select class="form-control form-control-alternative" id="kelas_tujuan" name="kelas_tujuan">
                        <option value="">--Pilih Kelas Tujuan--</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{$kelas->id_kelas}}">{{$kelas->nama_kelas}} - {{$kelas->kompetensi_keahlian}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <select class="form-control form-control-alternative" name="tahun">
                        <option value="">--Pilih Tahun Ajaran--</option>
                        @php $now = Date('Y'); @endphp
                        @for($i=$now;$i <= $now+2;$i++)
                            <option value="{{$i}}/{{$i+1}}">{{$i}}/{{$i+1}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-3">
                    <button class="btn btn-success">Simpan</button>
                </div>
            </div>
            <br>
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Daftar Siswa</h3>
                </div>
                <div class="col-lg-7">
                    <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Check All</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Kelas</th>
                        </tr>
                        </thead>
                        <tbody id="siswa_list">
                        @foreach($siswaList as $siswa)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>{{$siswa->nisn}}</td>
                                    <td>{{$siswa->nama}}</td>
                                    <td>{{$siswa->nama_kelas}} - {{$siswa->kompetensi_keahlian}}</td>
                                </tr>
                        @endforeach
                        <tr id="none">
                            <td colspan="4" align="center" style="font-weight: bold;">Tidak Ada Data !</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script-js')
    <script>
        $(document).ready(function () {
            $('#siswa_list tr').hide();
            $('#none').show();

            $('#kelas_awal').change(function () {
                var key = $(this).val();
                search_table(key);
            });
            function search_table(value) {
                if(value != '') {
                    $('#siswa_list tr ').each(function () {
                        var found = 'false';
                        $(this).each(function () {
                            if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                                found = 'true';
                            }
                        });
                        if (found == 'true') {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }else {
                    $('#siswa_list tr').hide();
                    $('#none').show();
                }
            }
        });
    </script>
@endsection
