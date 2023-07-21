@extends('layout.superAdminLayout')

<x-header>
    @slot('title')
        Bengkel | PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')

<div class="body">
    <div class="halaman-admin-input-bengkel">
        <div class="judul-halaman">
            <span>Input Bengkel</span>
        </div>
        <div class="input-bengkel-card">
            <form action="/super-admin/bengkel" method="POST">
                @csrf
                <div class="kolom1">
                    <div class="item container1">
                        <label for="">Nama Mitra</label>
                        <input type="text" placeholder="nama mitra bengkel" name="nama_mitra" id="nama_mitra" class="form-control @error('nama_mitra') is-invalid  @enderror" autofocus>
                        @error('nama_mitra')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container2">
                        <label for="">No Telepon</label>
                        <input type="number" placeholder="no telepon" name="no_telepon" id="no_telepon" class="form-control @error('no_telepon') is-invalid  @enderror">
                        @error('no_telepon')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container3">
                        <label for="">Email</label>
                        <input type="text" placeholder="email" name="email" id="email" class="form-control @error('email') is-invalid  @enderror">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container4">
                        <label for="">Alamat</label>
                        <textarea cols="0" rows="3" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid  @enderror"></textarea>
                        @error('alamat')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container5">
                        <label for="">Kode Pos</label>
                        <input type="number" placeholder="kode pos" name="kode_pos" id="kode_pos" class="form-control @error('kode_pos') is-invalid  @enderror">
                        @error('kode_pos')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="tombol">
                    <a href="/super-admin/bengkel">
                        <button type="button" class="btn btn-info">Back</button>
                    </a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection