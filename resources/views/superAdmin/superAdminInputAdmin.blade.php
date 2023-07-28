@extends('layout.superAdminLayout')

<x-header>
    @slot('title')
        Admin | PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')
    <div class="body">
        <div class="halaman-super-admin-input-admin">
            <div class="judul-halaman">
                <span>Input Admin</span>
            </div>
            <div class="input-admin-card">
                @if ($errors->has('adminAda'))
                    <div class="alert alert-danger">
                        {{ $errors->first('adminAda') }}
                    </div>
                @endif
                <form action="/super-admin/admin" method="POST">
                    @csrf
                    <div class="kolom1">
                        <div class="item container1">
                            <label for="">First Name</label>
                            <input type="text" name="first_name" id="first_name" placeholder="first name"
                                class="form-control @error('first_name') is-invalid @enderror" autofocus>
                            @error('first_name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item container2">
                            <label for="">Last Name</label>
                            <input type="text" name="last_name" id="last_name" placeholder="last name"
                                class="form-control @error('last_name') is-invalid @enderror">
                            @error('last_name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item container3">
                            <label for="">Jenis Kelamin</label>
                            <div class="radiobuton">
                                <label for="">Laki-Laki</label>
                                <input type="radio" name="gender" value="Laki-Laki">
                                <label for="">Perempuan</label>
                                <input type="radio" name="gender" value="Perempuan">
                            </div>
                            @error('gender')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item container4">
                            <label for="">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="tempat lahir"
                                class="form-control @error('tempat_lahir') is-invalid @enderror">
                            @error('tempat_lahir')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item container5">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror">
                            @error('tanggal_lahir')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item container6">
                            <label for="">No Telepon</label>
                            <input type="number" name="no_telepon" id="no_telepon" placeholder="no telepon"
                                class="form-control @error('no_telepon') is-invalid @enderror">
                            @error('no_telepon')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item container7">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" placeholder="alamat email"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item container8">
                            <label for="">Kota</label>
                            <input type="text" name="kota" id="kota" placeholder="kota"
                                class="form-control @error('kota') is-invalid @enderror">
                            @error('kota')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item container9">
                            <label for="">Kode Pos</label>
                            <input type="number" name="kode_pos" id="kode_pos" placeholder="kode pos"
                                class="form-control @error('kode_pos') is-invalid @enderror">
                            @error('kode_pos')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item container10">
                            <label for="">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="1" rows="3"
                                class="form-control @error('alamat') is-invalid @enderror"></textarea>
                            @error('alamat')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item container11">
                            <label for="">Kebangsaan</label>
                            <input type="text" name="kebangsaan" id="kebangsaan" placeholder="kebangsaan"
                                class="form-control @error('kebangsaan') is-invalid @enderror">
                            @error('kebangsaan')
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
