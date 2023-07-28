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
                        <li>
                            <button type="button" class="btn btn-primary"data-bs-toggle="modal"
                                data-bs-target="#inputBengkelSuper">Tambah</button>
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
                                    <td>
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

            {{-- Modal --}}
            <div class="modal fade" id="inputBengkelSuper" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Input Bengkel</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/admin/bengkel" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="kolom1">
                                    <div class="item container1">
                                        <label for="">Nama Mitra</label>
                                        <input type="text" placeholder="nama mitra bengkel" name="nama_mitra"
                                            id="nama_mitra" class="form-control @error('nama_mitra') is-invalid  @enderror"
                                            autofocus>
                                        @error('nama_mitra')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container2">
                                        <label for="">No Telepon</label>
                                        <input type="number" placeholder="no telepon" name="no_telepon" id="no_telepon"
                                            class="form-control @error('no_telepon') is-invalid  @enderror">
                                        @error('no_telepon')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container3">
                                        <label for="">Email</label>
                                        <input type="text" placeholder="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid  @enderror">
                                        @error('email')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container4">
                                        <label for="">Alamat</label>
                                        <textarea cols="0" rows="3" name="alamat" id="alamat"
                                            class="form-control @error('alamat') is-invalid  @enderror"></textarea>
                                        @error('alamat')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container5">
                                        <label for="">Kode Pos</label>
                                        <input type="number" placeholder="kode pos" name="kode_pos" id="kode_pos"
                                            class="form-control @error('kode_pos') is-invalid  @enderror">
                                        @error('kode_pos')
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
