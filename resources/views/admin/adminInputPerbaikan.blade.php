@extends('layout.adminLayout')

<x-header>
    @slot('title')
        Perbaikan | PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')
    <div class="body">
        <div class="halaman-admin-input-perbaikan">
            <div class="judul-halaman">
                <span>Input Perbaikan</span>
            </div>
            <div class="input-perbaikan-card">
                <form action="/admin/inputPerbaikan/{{ $dataReport->id }}" method="POST">
                    @csrf
                    <div class="kolom1">
                        <div class="item container1">
                            <label for="">Id Report</label>
                            <input type="text" value="{{ $dataReport->id }}" readonly>
                            {{-- @error('nama_mitra')
                                <span class="error">{{ $message }}</span>
                            @enderror --}}
                        </div>
                        <div class="item container2">
                            <label for="">Nama Driver</label>
                            <input type="text" value="{{ $dataReport->nama_driver }}" readonly>
                        </div>
                        <div class="item container3">
                            <label for="">Mitra Bengkel</label>
                            <select name="mitra" id="mitra" class="form-control @error('mitra') is-invalid @enderror">
                                <option value="">--Mitra--</option>
                                @foreach ($dataBengkel as $mitra)
                                    <option value="{{ $mitra->id }}">{{ $mitra->nama_mitra }}</option>
                                @endforeach
                            </select>
                            @error('mitra')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="item container4">
                            <label for="">Tanggal Perbaikan</label>
                            <input type="date" name="tanggal_perbaikan" id="tanggal_perbaikan" class="form-control @error('tanggal_perbaikan') is-invalid @enderror">
                            @error('tanggal_perbaikan')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" item container5">
                            <label for="">No Polisi</label>
                            <input type="text" name="no_polisi" value="{{ $dataReport->no_polisi }}"  readonly>
                        </div>
                    
                    </div>
                    <div class="tombol">
                        <a href="/admin/reportForm">
                            <button type="button" class="btn btn-info">Back</button>
                        </a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection