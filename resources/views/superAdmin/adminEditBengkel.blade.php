@extends('layout.superAdminLayout')

<x-header>
    @slot('title')
        Bengkel | PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')

<div class="body">
    <div class="halaman-admin-edit-bengkel">
        <div class="judul-halaman">
            <span>Edit Bengkel</span>
        </div>
        <div class="edit-bengkel-card">
            <form action="/super-admin/bengkel/{{ $bengkel->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="kolom1">
                    <div class="item container1">
                        <label for="">Nama Mitra</label>
                        <input type="text" value="{{ $bengkel->nama_mitra }}" name="nama_mitra" id="nama_mitra" autofocus>
                    </div>
                    <div class="item container2">
                        <label for="">No Telepon</label>
                        <input type="number" value="{{ $bengkel->no_telepon }}" name="no_telepon" id="no_telepon">
                    </div>
                    <div class="item container3">
                        <label for="">Email</label>
                        <input type="text" value="{{ $bengkel->email }}" name="email" id="email">
                    </div>
                    <div class="item container4">
                        <label for="">Alamat</label>
                        <textarea cols="0" rows="3" name="alamat" id="alamat">{{ $bengkel->alamat }}</textarea>
                    </div>
                    <div class="item container5">
                        <label for="">Kode Pos</label>
                        <input type="number" value="{{ $bengkel->kode_pos }}" name="kode_pos" id="kode_pos">
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