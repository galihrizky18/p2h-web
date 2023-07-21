@extends('layout.superAdminLayout')

<x-header>
    @slot('title')
        Driver | PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')

<div class="body">
    <div class="halaman-admin-input-akun-driver">
        <div class="judul-halaman">
            <span>Input Akun Driver</span>
        </div>
        <div class="input-akun-driver-card">
            @if($errors->has('driverAda'))
                        <div class="alert alert-danger">
                            {{ $errors->first('driverAda') }}
                        </div>
                    @endif
            <form action="/super-admin/inputUser/driver" method="POST">
                @csrf
                <div class="kolom1">
                    <div class="item container1">
                        <label for="">Id Driver</label>
                        <select name="id_driver" id="id_driver" class="form-control @error('id_driver') is-invalid  @enderror">
                            <option value="">-- ID Driver --</option>
                            @foreach ($dataDriver as $data)
                                <option value="{{ $data->id }}" data-nama-driver="{{ $data->first_name }} {{ $data->last_name }}">{{ $data->id }} - {{ $data->first_name }}</option>
                            @endforeach
                        </select>
                        @error('id_driver')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container2">
                        <label for="">Nama Driver</label>
                        <input type="text" name="nama_driver" id="nama_driver" readonly>
                        @error('nama_driver')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container3">
                        <label for="">Email</label>
                        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid  @enderror">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container4">
                        <label for="">Username</label>
                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid  @enderror">
                        @error('username')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container5">
                        <label for="">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid  @enderror">
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                </div>
                <div class="tombol">
                    <a href="/super-admin/driver">
                        <button type="button" class="btn btn-info">Back</button>
                    </a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection