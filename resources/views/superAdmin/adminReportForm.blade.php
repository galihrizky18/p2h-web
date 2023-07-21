@extends('layout.superAdminLayout')

<x-header>
    @slot('title')
        Report Form | PT.Satria Bahana Sara
    @endslot
</x-header>

@section('body')
    <div class="body">
        <div class="halaman-report-form-super">
            <div class="container judul-halaman">
                <span>Report Form</span>
            </div>

            <div class="container main-report-form">

                <div class="filter">
                    <div class="filter1 filters">
                        <label for="">Filter Tanggal</label>
                        <div class="range-date">
                            <input type="date" name="tanggal_awal" id="tanggal_awal">
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir">
                            <button type="submit" id="tombol-filter">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container data-report-form">
                @if (session('delete'))
                    <div class="alert alert-danger">
                        {{ session('delete') }}
                    </div>
                @endif
                <div class="table" id="table-filter">
                    <table id="myTable" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width='10px'>No</th>
                                <th width='10px'>Id Driver</th>
                                <th width='200px'>Nama Driver</th>
                                <th width='50px'>Shift</th>
                                <th width='150px'>No Polisi</th>
                                <th width='120px'>Mobil</th>
                                <th width='200px'>Tanggal Input</th>
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
                                    <td>{{ $data->tanggal_input }}</td>
                                    <td>
                                        <div class="tombol">
                                            <a href="/super-admin/detailReport/{{ $data->id }}">
                                                <button type="button" class="btn btn-warning ">Detail</button>
                                            </a>
                                            <a href="/super-admin/inputPerbaikan/{{ $data->id }}">
                                                <button type="button" class="btn btn-info " style=" width: 130px">Input
                                                    Perbaikan</button>
                                            </a>
                                            <a href="">
                                                <button type="button" class="btn btn-success ">Cetak</button>
                                            </a>
                                            <a href="/super-admin/deleteReportSuper/{{ $data->id }}">
                                                <button type="button" class="btn btn-danger ">Delete</button>
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
