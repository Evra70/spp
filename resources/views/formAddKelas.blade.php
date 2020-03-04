@extends('master.master')

@section('page-title', 'Form Tambah Kelas')

@section('title','Tambah Kelas')

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
                    <h3 class="mb-0 text-center">Form Tambah Kelas</h3>
                </div>
                <div class="card-body">
                    <form action="/proses/addKelas" method="post">
                        {{csrf_field()}}
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('nama_kelas') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-email">Nama Kelas</label>
                                        <input type="text" id="input-fullname" autocomplete="off"
                                               onkeypress="this.value = this.value + event.key.toUpperCase(); return false;"
                                               class="form-control form-control-alternative" placeholder="EX: XII"  name="nama_kelas">
                                    </div>
                                    @if ($errors->has('nama_kelas'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                        <strong>{{ $errors->first('nama_kelas') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('kompetensi_keahlian') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-username">Kompetensi Keahlian</label>
                                        <input type="text" id="input-username" autocomplete="off"
                                               onkeypress="this.value = this.value + event.key.toUpperCase(); return false;"
                                               class="form-control form-control-alternative" placeholder="EX: RPL" name="kompetensi_keahlian">
                                    </div>
                                    @if ($errors->has('kompetensi_keahlian'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                        <strong>{{ $errors->first('kompetensi_keahlian') }}</strong>
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
