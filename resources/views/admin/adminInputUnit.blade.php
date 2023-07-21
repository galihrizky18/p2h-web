@extends('layout.adminLayout')

<x-header>
    @slot('title')
        Unit | PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')

<div class="body">
    <div class="halaman-admin-input-unit">
        <div class="judul-halaman">
            <span>Input Unit</span>
        </div>
        <div class="input-unit-card">
            @if($errors->has('unitAda'))
                    <div class="alert alert-danger">
                        {{ $errors->first('unitAda') }}
                    </div>
            @endif
            <form action="/admin/unit" method="POST">
                <div class="kolom1">
                    @csrf
                    <div class="item container1">
                        <label for="">No Polisi</label>
                        <input type="text" placeholder="no polisi" name="no_polisi" id="no_polisi" class="form-control @error('no_polisi') is-invalid @enderror" autofocus>
                        @error('no_polisi')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container2">
                        <label for="">Merk Mobil</label>
                        <input type="text" placeholder="merk mobil" name="merk_mobil" id="merk_mobil" class="form-control @error('merk_mobil') is-invalid @enderror">
                        @error('merk_mobil')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container3">
                        <label for="">Model Mobil</label>
                        <input type="text" placeholder="model mobil" name="model_mobil" id="model_mobil" class="form-control @error('model_mobil') is-invalid @enderror">
                        @error('model_mobil')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container4">
                        <label for="">Warna</label>
                        <input type="text" placeholder="warna" name="warna" id="warna" class="form-control @error('warna') is-invalid @enderror">
                        @error('warna')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container5">
                        <label for="">No Mesin</label>
                        <input type="text" placeholder="no mesin" name="no_mesin" id="no_mesin" class="form-control @error('no_mesin') is-invalid @enderror">
                        @error('no_mesin')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="item container6">
                        <label for="">Tahun Pembuatan</label>
                        <input type="number" min="1900" max="2099" step="1" placeholder="tahun pembuatan" name="tahun_pembuatan" id="tahun_pembuatan" class="form-control @error('tahun_pembuatan') is-invalid @enderror">
                        @error('tahun_pembuatan')
                            <span class="error">{{ $message }}</span>
                        @enderror
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