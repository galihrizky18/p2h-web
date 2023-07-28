@extends('layout.superAdminLayout')

<x-header>
    @slot('title')
        Admin | PT.Satria Bahana Sara
    @endslot
</x-header>

@section('body')
    <div class="body">
        <div class="halaman-super-admin-admin">
            <x-topbar></x-topbar>
            <div class="container judul-halaman">
                <span>Admin</span>
            </div>

            <div class="container main-super-admin-admin">
                <div class="menu">
                    <ul>
                        <li>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#inputAdminSuper">Tambah</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-success tombol-input-akun" data-bs-toggle="modal"
                                data-bs-target="#inputAkunAdminSuper">Input Akun</button>
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
                @if (session('successAkunAdmin'))
                    <div class="alert alert-success">
                        {{ session('successAkunAdmin') }}
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
                                <th>Nama Driver</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                                <th>tombol</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $d->first_name }} {{ $d->last_name }}</td>
                                    <td>{{ $d->tempat_lahir }}, {{ $d->tanggal_lahir }}</td>
                                    <td>0{{ $d->no_telepon }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>
                                        <div class="tombol">
                                            <a href="/super-admin/admin/{{ $d['id'] }}/edit">
                                                <button type="button" class="btn btn-warning ">Edit</button>
                                            </a>

                                            <form action="/super-admin/admin/{{ $d['id'] }}" method="POST"
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

            <!-- Modal -->
            <div class="modal fade akunAdmin" id="inputAkunAdminSuper" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Input Akun Admin</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/super-admin/inputUser/admin" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="kolom1">
                                    <div class="item container1">
                                        <label for="">Id Admdin</label>
                                        <select name="id_admin" id="id_admin"
                                            class="form-control @error('id_admin') is-invalid  @enderror">
                                            <option value="">-- ID Admin --</option>
                                            @foreach ($data as $data)
                                                <option value="{{ $data->id }}"
                                                    data-nama-admin="{{ $data->first_name }} {{ $data->last_name }}">
                                                    {{ $data->id }}
                                                    - {{ $data->first_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_admin')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container2">
                                        <label for="">Nama Admin</label>
                                        <input type="text" name="nama_admin" id="nama_admin" readonly>
                                        @error('name_admin')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container3">
                                        <label for="">Email</label>
                                        <input type="text" name="email" id="email"
                                            class="form-control @error('email') is-invalid  @enderror">
                                        @error('email')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container4">
                                        <label for="">Username</label>
                                        <input type="text" name="username" id="username"
                                            class="form-control @error('username') is-invalid  @enderror">
                                        @error('username')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container5">
                                        <label for="">Password</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid  @enderror">
                                        @error('password')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


            <div class="modal fade " id="inputAdminSuper" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Input Admin</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/super-admin/admin" method="POST" id="inputAdminSuper">
                            <div class="modal-body">
                                @csrf
                                <div class="kolom">
                                    <div class="item container1">
                                        <label for="">First Name</label>
                                        <input type="text" name="first_name" id="first_name" placeholder="first name"
                                            class="form-control @error('first_name') is-invalid @enderror" autofocus>
                                        @error('first_name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container2">
                                        <label for="">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" placeholder="last name"
                                            class="form-control @error('last_name') is-invalid @enderror">
                                        @error('last_name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container3">
                                        <label for="">Jenis Kelamin</label>
                                        <div class="radiobuton">
                                            <label for="">Laki-Laki</label>
                                            <input type="radio" name="gender" value="Laki-Laki">
                                            <label for="">Perempuan</label>
                                            <input type="radio" name="gender" value="Perempuan">
                                        </div>
                                        @error('gender')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container4">
                                        <label for="">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" id="tempat_lahir"
                                            placeholder="tempat lahir"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror">
                                        @error('tempat_lahir')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container5">
                                        <label for="">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror">
                                        @error('tanggal_lahir')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container6">
                                        <label for="">No Telepon</label>
                                        <input type="number" name="no_telepon" id="no_telepon" placeholder="no telepon"
                                            class="form-control @error('no_telepon') is-invalid @enderror">
                                        @error('no_telepon')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container7">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="email" placeholder="alamat email"
                                            class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container8">
                                        <label for="">Kota</label>
                                        <input type="text" name="kota" id="kota" placeholder="kota"
                                            class="form-control @error('kota') is-invalid @enderror">
                                        @error('kota')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container9">
                                        <label for="">Kode Pos</label>
                                        <input type="number" name="kode_pos" id="kode_pos" placeholder="kode pos"
                                            class="form-control @error('kode_pos') is-invalid @enderror">
                                        @error('kode_pos')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container10">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="1" rows="3"
                                            class="form-control @error('alamat') is-invalid @enderror"></textarea>
                                        @error('alamat')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="item container11">
                                        <label for="">Kebangsaan</label>
                                        <input type="text" name="kebangsaan" id="kebangsaan" placeholder="kebangsaan"
                                            class="form-control @error('kebangsaan') is-invalid @enderror">
                                        @error('kebangsaan')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
