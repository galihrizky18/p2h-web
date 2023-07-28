@extends('layout.superAdminLayout')

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
                        <li>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#inputUnitSuper">Tambah</button>
                        </li>

                    </ul>
                </div>

            </div>
            <div class="container data-report-form">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('successDelete'))
                    <div class="alert alert-danger">
                        {{ session('successDelete') }}
                    </div>
                @endif
                @if (session('successUpdate'))
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
                                    <td>
                                        <div class="tombol">
                                            <a href="/super-admin/unit/{{ $d->id }}/edit">
                                                <button type="button" class="btn btn-warning ">Edit</button>
                                            </a>
                                            <form action="/super-admin/unit/{{ $d->id }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE') {{-- untuk memanipulasi method post menjadi delete --}}
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('Yakin mau hapus')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="inputUnitSuper" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Input Unit</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/super-admin/unit" method="POST">
                            <div class="modal-body">
                                <div class="kolom1">
                                    @csrf
                                    <div class="item container1">
                                        <label for="">No Polisi</label>
                                        <input type="text" placeholder="no polisi" name="no_polisi" id="no_polisi"
                                            class="form-control @error('no_polisi') is-invalid @enderror" autofocus>
                                        @error('no_polisi')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container2">
                                        <label for="">Merk Mobil</label>
                                        <input type="text" placeholder="merk mobil" name="merk_mobil" id="merk_mobil"
                                            class="form-control @error('merk_mobil') is-invalid @enderror">
                                        @error('merk_mobil')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container3">
                                        <label for="">Model Mobil</label>
                                        <input type="text" placeholder="model mobil" name="model_mobil" id="model_mobil"
                                            class="form-control @error('model_mobil') is-invalid @enderror">
                                        @error('model_mobil')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container4">
                                        <label for="">Warna</label>
                                        <input type="text" placeholder="warna" name="warna" id="warna"
                                            class="form-control @error('warna') is-invalid @enderror">
                                        @error('warna')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container5">
                                        <label for="">No Mesin</label>
                                        <input type="text" placeholder="no mesin" name="no_mesin" id="no_mesin"
                                            class="form-control @error('no_mesin') is-invalid @enderror">
                                        @error('no_mesin')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container6">
                                        <label for="">Tahun Pembuatan</label>
                                        <input type="number" min="1900" max="2099" step="1"
                                            placeholder="tahun pembuatan" name="tahun_pembuatan" id="tahun_pembuatan"
                                            class="form-control @error('tahun_pembuatan') is-invalid @enderror">
                                        @error('tahun_pembuatan')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
