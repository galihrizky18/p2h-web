@extends('layout.adminLayout')

<x-header>
    @slot('title')
        Report Form | PT.Satria Bahana Sara
    @endslot
</x-header>

@section('body')
<div class="body">
    <div class="halaman-report-form">
        <div class="container judul-halaman">
            <span>Report Form</span>
        </div>

        <div class="container main-report-form">    
            <div class="filter">
                <div class="filter1 filters">
                    <label for="">Filter Tanggal Report</label>
                    <div class="range-date">
                        <input type="date" name="tanggal_awal" id="tanggal_awal" >
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir">
                        <button type="submit" id="tombol-filter-report">Cari</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container data-report-form">
            <div class="table">
                <table id="myTable" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Driver</th>
                            <th>Nama Driver</th>
                            <th>Shift</th>
                            <th>No Polisi</th>
                            <th>Mobil</th>
                            <th>Tanggal Input</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($dataReport as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->id_driver }}</td>
                                <td>{{ $data->nama_driver }}</td>
                                <td>{{ $data->shift }}</td>
                                <td>{{ $data->no_polisi }}</td>
                                <td>{{ $data->unit->merk_mobil }} {{ $data->unit->model_mobil }}</td>
                                <td >{{ $data->tanggal_input }}</td>
                                <td >
                                    <div class="tombol">
                                        <a href="/admin/detailReport/{{ $data->id }}" class="detail">
                                            <button type="button" class="btn btn-warning ">Detail</button>
                                        </a>
                                        <a href="">
                                            <button type="button" class="btn btn-success ">Cetak Laporan</button>
                                        </a>
                                    </div>
                                </td>
                            
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection