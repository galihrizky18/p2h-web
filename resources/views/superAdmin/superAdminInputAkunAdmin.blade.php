@extends('layout.superAdminLayout')

<x-header>
    @slot('title')
        Admin | PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')

<div class="body">
    <div class="halaman-super-admin-input-akun-admin">
        <div class="judul-halaman">
            <span>Input Akun Admin</span>
        </div>
        <div class="input-akun-admin-card">
            @if($errors->has('adminAda'))
                        <div class="alert alert-danger">
                            {{ $errors->first('adminAda') }}
                        </div>
                    @endif
            <form action="/super-admin/inputUser/admin" method="POST">
                @csrf
                <div class="kolom1">
                    <div class="item container1">
                        <label for="">Id Admdin</label>
                        <select name="id_admin" id="id_admin" class="form-control @error('id_admin') is-invalid  @enderror">
                            <option value="">-- ID Admin --</option>
                            @foreach ($dataAdmin as $data)
                                <option value="{{ $data->id }}" data-nama-admin="{{ $data->first_name }} {{ $data->last_name }}">{{ $data->id }} - {{ $data->first_name }}</option>
                            @endforeach
                        </select>
                        @error('id_admin')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container2">
                        <label for="">Nama Admin</label>
                        <input type="text" name="nama_admin" id="nama_admin" readonly>
                        @error('name_admin')
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
                    <a href="/super-admin/admin">
                        <button type="button" class="btn btn-info">Back</button>
                    </a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection