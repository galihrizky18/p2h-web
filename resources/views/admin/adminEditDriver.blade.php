@extends('layout.adminLayout')

<x-header>
    @slot('title')
        Driver | PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')

<div class="body">
    <div class="halaman-admin-edit-driver">
        <div class="judul-halaman">
            <span>Edit Driver</span>
        </div>
        <div class="edit-driver-card">
            <form action="/admin/driver/{{ $data->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="kolom1">
                    <div class="item container1">
                        <label for="">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ $data->first_name }}">
                    </div>
                    <div class="item container2">
                        <label for="">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{ $data->last_name }}" >
                    </div>
                    <div class="item container3">
                        <label for="">Jenis Kelamin</label>
                        <div class="radiobuton" >
                            <label for="">Laki-Laki</label>
                            <input type="radio" name="gender" value="Laki-Laki" {{ $data->gender == 'Laki-Laki' ? 'checked' : '' }}>
                            <label for="">Perempuan</label>
                            <input type="radio" name="gender" value="Perempuan" {{ $data->gender == 'Perempuan' ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="item container4">
                        <label for="">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ $data->tempat_lahir }}" >
                    </div>
                    <div class="item container5">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ $data->tanggal_lahir }}">
                    </div>
                    <div class="item container6">
                        <label for="">No Telepon</label>
                        <input type="number" name="no_telepon" id="no_telepon" value="{{ $data->no_telepon }}" >
                    </div>
                    <div class="item container7">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email" value="{{ $data->email }}" >
                    </div>
                    <div class="item container8">
                        <label for="">Kota</label>
                        <input type="text" name="kota" id="kota" value="{{ $data->kota }}" >
                    </div>
                    <div class="item container9">
                        <label for="">Kode Pos</label>
                        <input type="number" name="kode_pos" id="kode_pos" value="{{ $data->kode_pos }}" >
                    </div>
                    <div class="item container10">
                        <label for="">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="1" rows="3" >{{ $data->alamat }}</textarea>
                    </div>
                    <div class="item container11">
                        <label for="">Kebangsaan</label>
                        <input type="text" name="kebangsaan" id="kebangsaan" value="{{ $data->kebangsaan }}" >
                    </div>
                </div>
                <div class="tombol">
                    <a href="/admin/driver">
                        <button type="button" class="btn btn-info">Back</button>
                    </a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection