@extends('layout.driverLayout')

<x-header>
    @slot('title')
        Report || PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')
    <div class="body">
        <div class="halaman-driver-report">
            <div class="judul">
                <span>Report</span>
            </div>

            <div class="filterDriver">
                <div class="filter">
                    <div class="filter1 filters">
                        <label for="">Filter Tanggal Report</label>
                        <div class="range-date">
                            <input type="date" name="tanggal_awal" id="tanggal_awal" >
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir">
                            <button type="submit" id="tombol-filter-report-driver">Cari</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="isi">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table">
                    <table id="myTable" class="display nowrap tablereport" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="10px">No</th>
                                <th>Nama Driver</th>
                                <th>Shift</th>
                                <th>No Polisi</th>
                                <th>Tanggal Input</th>
                                <th width="20px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($dataReport as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama_driver }}</td>
                                    <td>{{ $data->shift }}</td>
                                    <td>{{ $data->no_polisi }}</td>
                                    <td>{{ $data->tanggal_input }}</td>
                                    <td>
                                        <div class="tombol">
                                            <a href="/driver/detailReport/{{ $data->id }}">
                                                <button type="button" class="btn btn-warning" style="margin-right: 10px; width: 100px">Detail</button>
                                            </a>
                                                <button type="button" class="btn btn-success" style="margin-right: 10px; width: 130px">Cetak Laporan</button>
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