@extends('master.master')

@section('page-title', 'Form Tambah Siswa')

@section('title','Tambah Siswa')

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
                    <h3 class="mb-0 text-center">Form Tambah Siswa</h3>
                </div>
                <div class="card-body">
                    <form action="/proses/addSiswa" method="post">
                        {{csrf_field()}}
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-email">Nama Siswa</label>
                                        <input type="text" id="input-fullname" autocomplete="off" class="form-control form-control-alternative" placeholder="EX: Ephraim Jehudah"  name="nama">
                                    </div>
                                    @if ($errors->has('nama'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('nisn') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-email">NISN</label>
                                        <input type="text" id="input-fullname" autocomplete="off" class="form-control form-control-alternative" placeholder="EX: 60123482348776"  name="nisn">
                                    </div>
                                    @if ($errors->has('nisn'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                    <strong>{{ $errors->first('nisn') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('nis') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-email">NIS</label>
                                        <input type="text" id="input-fullname" autocomplete="off" class="form-control form-control-alternative" placeholder="EX: 192356"  name="nis">
                                    </div>
                                    @if ($errors->has('nis'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                    <strong>{{ $errors->first('nis') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('tahun') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-email">Tahun Ajaran</label>
                                        <select class="form-control form-control-alternative" name="tahun">
                                            <option value="">--Pilih Tahun Ajaran--</option>
                                            @php $now = Date('Y'); @endphp
                                            @for($i=$now;$i <= $now+2;$i++)
                                                <option value="{{$i}}/{{$i+1}}">{{$i}}/{{$i+1}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    @if ($errors->has('tahun'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                    <strong>{{ $errors->first('tahun') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('kelas') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-email">Kelas</label>
                                        <select class="form-control form-control-alternative" name="kelas">
                                            <option value="">--Pilih Kelas--</option>
                                            @foreach($kelasList as $kelas)
                                                <option value="{{$kelas->id_kelas}}">{{$kelas->nama_kelas}} - {{$kelas->kompetensi_keahlian}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('kelas'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                    <strong>{{ $errors->first('kelas') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('nominal') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-email">Nominal Spp</label>
                                        <input type="text" id="input-fullname" autocomplete="off" class="form-control form-control-alternative" placeholder="EX: 150000"  name="nominal">
                                    </div>
                                    @if ($errors->has('nominal'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                    <strong>{{ $errors->first('nominal') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('no_telp') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-email">No Telp</label>
                                        <input type="text" id="input-fullname" autocomplete="off" class="form-control form-control-alternative" placeholder="EX: 088232302935"  name="no_telp">
                                    </div>
                                    @if ($errors->has('no_telp'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                    <strong>{{ $errors->first('no_telp') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-email">Alamat</label>
                                        <input type="text" id="input-fullname" autocomplete="off" class="form-control form-control-alternative" placeholder="EX: Jl. Tentara Pelajar"  name="alamat">
                                    </div>
                                    @if ($errors->has('alamat'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="my-4" />
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="submit" value="Tambah" class="btn btn-info">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
