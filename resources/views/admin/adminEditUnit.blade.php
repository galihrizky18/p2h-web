@extends('layout.adminLayout')

<x-header>
    @slot('title')
        Unit | PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')
    <div class="body">
        <div class="halaman-admin-edit-unit">
            <div class="judul-halaman">
                <span>Edit Unit</span>
            </div>
            <div class="edit-unit-card">
                <form action="/admin/unit/{{ $unit->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="kolom1">
                        <div class="item container1">
                            <label for="">No Polisi</label>
                            <input type="text" value="{{ $unit->no_polisi }}" name="no_polisi" id="no_polisi" autofocus>
                        </div>
                        <div class="item container2">
                            <label for="">Merk Mobil</label>
                            <input type="text" value="{{ $unit->merk_mobil }}" name="merk_mobil" id="merk_mobil">
                        </div>
                        <div class="item container3">
                            <label for="">Model Mobil</label>
                            <input type="text" value="{{ $unit->model_mobil }}" name="model_mobil" id="model_mobil">
                        </div>
                        <div class="item container4">
                            <label for="">Warna</label>
                            <input type="text" value="{{ $unit->warna }}" name="warna" id="warna">
                        </div>
                        <div class="item container5">
                            <label for="">No Mesin</label>
                            <input type="text" value="{{ $unit->no_mesin }}" name="no_mesin" id="no_mesin">
                        </div>
                        <div class="item container6">
                            <label for="">Tahun Pembuatan</label>
                            <input type="number" min="1900" max="2099" step="1"
                                value="{{ $unit->tahun_pembuatan }}" name="tahun_pembuatan" id="tahun_pembuatan">
                        </div>
                    </div>
                    <div class="tombol">
                        <a href="/admin/unit">
                            <button type="button" class="btn btn-info">Back</button>
                        </a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
