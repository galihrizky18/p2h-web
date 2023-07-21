@extends('layout.adminLayout')

<x-header>
    @slot('title')
        Perbaikan
    @endslot
</x-header>

@section('body')
    <div class="body">
        <div class="halaman-tambah-perbaikan">

            <div class="judul">
                <span>Tambah Perbaikan</span>
            </div>

            <form action="" method="POST">
                @csrf
                <div class="isi">
                    <div class="item">
                        <div class="col col1">
                            <label for="">Id report</label>
                            <select name="id_report" id="id_report">
                                <option value="">--Id Report--</option>
                                @foreach ($dataReport as $report)
                                    <option value="{{ $report->id }}"> {{ $report->id }} - {{ $report->no_polisi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col col2">
                            <label for="">Nama Driver</label>
                            <input type="text" name="nama_driver" id="nama_driver" value="" readonly>
                        </div>

                        <div class="col col3">
                            <label for="">No Polisi</label>
                            <input type="text" name="no_polisi" id="no_polisi" readonly>
                        </div>

                        <div class="col col4">
                            <label for="">tanggal Input</label>
                            <input type="date" name="tanggal_input" id="tanggal_input" readonly>
                        </div>

                        <div class="col col5">
                            <label for="">Mitra Bengkel</label>
                            <select name="mitra" id="mitra">
                                <option value="">--Mitra Bengkel--</option>
                                @foreach ($dataMitra as $mitra)
                                    <option value="{{ $mitra->id }}">{{ $mitra->id }} - {{ $mitra->nama_mitra }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col col6">
                            <label for="">Nama Mitra</label>
                            <input type="text" name="nama_mitra" id="nama_mitra" readonly>
                        </div>

                        <div class="col col7">
                            <label for="">No Telepon Mitra</label>
                            <input type="number" name="no_telepon_mitra" id="no_telepon_mitra" readonly>
                        </div>

                        <div class="col col8">
                            <label for="">Tanggal Perbaikan</label>
                            <input type="date" name="tanggal_perbaikan" id="tanggal_perbaikan">
                        </div>

                    </div>

                    <div class="tombol">
                        <a href="/admin/perbaikan">
                            <button type="button" class="btn btn-warning">Back</button>
                        </a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection