@extends('layout.adminLayout')

<x-header>
    @slot('title')
        Dashboard || PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')
    {{-- untuk body dalam halaman --}}
    <div class="body">
        <div class="dashboard-admin-body">
            <div class="container1 kolom">
                <span class="welcome-admin">Welcome {{ $dataUser->admin->first_name }}
                    {{ $dataUser->admin->last_name }}</span>
            </div>

            <div class="container2 kolom">
                <div class="item">

                    <div class="username">
                        {{ $dataUser->admin->first_name }} {{ $dataUser->admin->last_name }}
                    </div>
                    <div class="gambar">
                        <img src="{{ asset('asset/admin/profile-icon.svg') }}" alt="">
                    </div>
                </div>
            </div>

            <div class="container3 kolom">
                <span class="judul">Driver</span>

                <div class="tombol">
                    <a href="/admin/driver">
                        <button type="button" class="btn btn-success ">Detail</button>
                    </a>
                </div>

                <div class="data">
                    <div class="table">
                        <table id="driverAdminDashboard" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col1">Id Driver</th>
                                    <th class="col2">Nama Driver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($dataDriver as $driver)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $driver->first_name }} {{ $driver->last_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container4 kolom">
                <span class="judul">Unit</span>

                <div class="tombol">
                    <a href="/admin/unit">
                        <button type="button" class="btn btn-success ">Detail</button>
                    </a>
                </div>

                <div class="data">
                    <div class="table">
                        <table id="unitAdminDashboard" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col1">Id Unit</th>
                                    <th class="col2">No Polisi</th>
                                    <th class="col3">Unit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($dataUnit as $unit)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $unit->no_polisi }}</td>
                                        <td>{{ $unit->merk_mobil }} {{ $unit->model_mobil }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container5 kolom">
                <span class="judul">Bengkel</span>

                <div class="tombol">
                    <a href="/admin/bengkel">

                        <button type="button" class="btn btn-success ">Detail</button>
                    </a>
                </div>

                <div class="data">
                    <div class="table">
                        <table id="bengkelAdminDashboard" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col1">Id Bengkel</th>
                                    <th class="col2">Mitra Bengkel</th>
                                    <th class="col3">No Telepon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($dataBengkel as $bengkel)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $bengkel->nama_mitra }}</td>
                                        <td>{{ $bengkel->no_telepon }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container6 kolom">
                <span class="judul">Perbaikan</span>

                <div class="tombol">
                    <a href="/admin/perbaikan">

                        <button type="button" class="btn btn-success ">Detail</button>
                    </a>
                </div>

                <div class="data">
                    <div class="table">
                        <table id="perbaikanAdminDashboard" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col1">No Polisi</th>
                                    <th class="col2">Mitra Bengkel</th>
                                    <th class="col3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($dataPerbaikan as $perbaikan)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $perbaikan->no_polisi }}</td>
                                        <td>{{ $perbaikan->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container7 kolom">
                <span class="judul">Report Form</span>

                <div class="tombol">
                    <a href="/admin/reportForm">

                        <button type="button" class="btn btn-success ">Detail</button>
                    </a>
                </div>

                <div class="data">
                    <div class="table">
                        <table id="reportAdminDashboard" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col1">Id Report</th>
                                    <th class="col2">No Polisi</th>
                                    <th class="col3">Nama Driver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($dataReport as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->no_polisi }}</td>
                                        <td>{{ $data->nama_driver }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
