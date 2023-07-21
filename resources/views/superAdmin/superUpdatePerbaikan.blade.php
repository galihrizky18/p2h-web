@extends('layout.superAdminLayout')

<x-header>
    @slot('title')
        Update Perbaikan
    @endslot
</x-header>

@section('body')
    <div class="body">
        <div class="halaman-update-perbaikan">
            <div class="judul">
                <span>Update Perbaikan</span>
            </div>

            <div class="isi">

                <form action="/super-admin/updatePerbaikan/{{ $dataPerbaikan->id }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form">
                        <div class="item item1">
                            <label for="">Id Perbaikan</label>
                            <input type="text" value="{{ $dataPerbaikan->id }}" readonly>
                        </div>
                        <div class="item item2">
                            <label for="">No Polisi</label>
                            <input type="text" value="{{ $dataPerbaikan->no_polisi }}" readonly>
                        </div>
                        <div class="item item3">
                            <label for="">Nama Mitra</label>
                            <input type="text" value="{{ $dataPerbaikan->mitra->nama_mitra }}" readonly>
                        </div>
                        <div class="item item4">
                            <label for="">Tanggal Perbaikan</label>
                            <input type="date" value="{{ $dataPerbaikan->tanggal_perbaikan }}" readonly>
                        </div>
                        <div class="item item5">
                            <label for="">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                class="form-control @error('tanggal_selesai') is-invalid @enderror">
                            @error('tanggal_selesai')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item item6">
                            <label for="">Biaya</label>
                            <div class="input">
                                <span>Rp. </span>
                                <input type="number" name="biaya" id="biaya"
                                    class=" form-control @error('biaya') is-invalid @enderror">
                            </div>
                            @error('biaya')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item item7">
                            <label for="">Upload Nota</label>
                            <input class="form-control @error('nota') is-invalid @enderror" type="file" id="formFile"
                                id="nota" name="nota[]" multiple>
                            @error('nota')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="tombol">
                        <a href="">
                            <button type="submit" class="btn btn-success ">Update</button>
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
