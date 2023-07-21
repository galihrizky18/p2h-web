@extends('layout.adminLayout')

<x-header>
    @slot('title')
        Bengkel | PT.Satria Bahana Sara
    @endslot
</x-header>

@section('body')
<div class="body">
    <div class="halaman-admin-bengkel">
        <div class="container judul-halaman">
            <span>Bengkel</span>
        </div>

        <div class="container main-admin-bengkel">
            <div class="menu">
                <ul>
                    <a href="/admin/inputBengkel">
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
                            <th>Nama Mitra</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Email</th>
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
                                <td>{{ $d->nama_mitra }}</td>
                                <td>{{ $d->alamat }}</td>
                                <td>0{{ $d->no_telepon }}</td>
                                <td>{{ $d->email }}</td>
                                <td >
                                    <div class="tombol">
                                        <a href="/admin/bengkel/{{ $d->id }}/edit">
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