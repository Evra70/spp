@extends('master.master')

@section('page-title', 'Form Edit Petugas')

@section('title','Edit Petugas')

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
                    <h3 class="mb-0 text-center">Form Edit Petugas</h3>
                </div>
                <div class="card-body">
                    <form action="/proses/editPetugas" method="post">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$petugas->id_petugas}}" name="id_petugas">
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('nama_petugas') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-email">Nama Petugas</label>
                                        <input type="text" id="input-fullname" autocomplete="off" value="{{$petugas->nama_petugas}}" class="form-control form-control-alternative" placeholder="EX: Ephraim Jehudah"  name="nama_petugas">
                                    </div>
                                    @if ($errors->has('nama_petugas'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                        <strong>{{ $errors->first('nama_petugas') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-username">Username</label>
                                        <input type="text" id="input-username" value="{{$petugas->username}}" autocomplete="off" class="form-control form-control-alternative" placeholder="EX: Evra777" name="username">
                                    </div>
                                    @if ($errors->has('username'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('level') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-username">Level</label>
                                        <select name="level"  class="form-control form-control-alternative">
                                            <option value="{{$petugas->level}}">{{$petugas->level == 'admin' ? "Admin":"Petugas"}}</option>
                                            <option value="">--Pilih Lavel--</option>
                                            <option value="admin">Admin</option>
                                            <option value="petugas">Petugas</option>
                                        </select>
                                        <br/>
                                        <div style="float: right;">
                                            <input type="checkbox" id="check" name="check" value="true"> <b>Klik Bila Ingin Ganti Password</b>
                                        </div>
                                    </div>
                                    @if ($errors->has('level'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row" id="pass">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-username">Password</label>
                                        <input type="password" id="filpass" value="{{$petugas->password}}" autocomplete="off" class="form-control form-control-alternative password" placeholder="EX: *******" name="password">
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row" id="compass">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                                        <label class="form-control-label" for="input-username">Konfirmasi Password</label>
                                        <input type="password" id="input-username" autocomplete="off" class="form-control form-control-alternative password" placeholder="EX: *******" name="confirm_password">
                                        <br/>
                                        <div style="float: right;">
                                            <input type="checkbox" id="pascheck"> <b id="tam">Tampilkan Password</b>
                                        </div>
                                    </div>
                                    @if ($errors->has('confirm_password'))
                                        <span class="help-block" style="color:red;margin-bottom: 5px;margin-top: -10px;">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="my-4" />
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="submit" value="Edit" class="btn btn-info">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-js')
    <script>
        $('document').ready(function () {
            $('#pass').hide();
            $('#compass').hide();

            $('#check').click(function () {
                if ($(this).is(':checked')){
                    $('#pass').show();
                    $('#compass').show();
                }else {
                    $('#pass').hide();
                    $('#compass').hide();
                }
            });

            $('#pascheck').click(function () {
                if ($(this).is(':checked')){
                    $('.password').attr('type','text');
                    $('#tam').html("Sembunyikan Password");
                }else {
                    $('.password').attr('type','password');
                    $('#tam').html("Tampilkan Password");
                }
            });
        });
    </script>
@endsection
