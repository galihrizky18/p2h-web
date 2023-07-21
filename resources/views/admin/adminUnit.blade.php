@extends('layout.adminLayout')

<x-header>
    @slot('title')
        Unit | PT.Satria Bahana Sara
    @endslot
</x-header>

@section('body')
<div class="body">
    <div class="halaman-admin-unit">
        <div class="container judul-halaman">
            <span>Unit</span>
        </div>

        <div class="container main-admin-unit">
            <div class="menu">
                <ul>
                    <a href="/admin/inputUnit">
                        <li>
                            <button type="button" class="btn btn-primary">Tambah</button>
                        </li>
                    </a>
                </ul>
            </div>
            <div class="filter">
                Ini Filter
            </div>
        </div>
        <div class="container data-report-form">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('successDelete'))
                <div class="alert alert-danger">
                    {{ session('successDelete') }}
                </div>
            @endif
            @if(session('successUpdate'))
                <div class="alert alert-success">
                    {{ session('successUpdate') }}
                </div>
            @endif
            <div class="table">
                <table id="myTable" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Polisi</th>
                            <th>Unit</th>
                            <th>No Mesin</th>
                            <th>Warna</th>
                            <th>Tahun Pembutan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp

                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $d->no_polisi }}</td>
                                <td>{{ $d->merk_mobil }} {{ $d->model_mobil }}</td>
                                <td>{{ $d->no_mesin }}</td>
                                <td>{{ $d->warna }}</td>
                                <td>{{ $d->tahun_pembuatan }}</td>
                                <td >
                                    <div class="tombol">
                                        <a href="/admin/unit/{{ $d->id }}/edit">
                                            <button type="button" class="btn btn-warning ">Edit</button>
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