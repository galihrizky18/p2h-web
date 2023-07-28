@extends('layout.adminLayout')

<x-header>
    @slot('title')
        Perbaikan | PT.Satria Bahana Sara
    @endslot
</x-header>

@section('body')
    <div class="body">
        <div class="halaman-perbaikan-report">
            <div class="container judul-halaman">
                <span>Perbaikan Report</span>
            </div>

            <div class="container main-perbaikan-report">
                <div class="filter">
                    <div class="filter1 filters">
                        <label for="">Filter Tanggal Perbaikan</label>
                        <div class="range-date">
                            <input type="date" name="tanggal_awal" id="tanggal_awal">
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir">
                            <button type="submit" id="tombol-filter-perbaikan-admin">Cari</button>
                        </div>
                    </div>
                    <div class="filter2 filters">
                        <label for="">Filter Tanggal Selesai</label>
                        <div class="range-date">
                            <input type="date" name="tanggal_awal" id="tanggal_awal_selesai">
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir_selesai">
                            <button type="submit" id="tombol-filter-perbaikan-selesai-admin">Cari</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container data-report-form">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table">
                    <table id="myTable" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>Id Report</th>
                                <th>No Polisi</th>
                                <th>Nama Mitra</th>
                                <th>Tanggal Perbaikan</th>
                                <th>Tanggal Selesai</th>
                                <th>Biaya</th>
                                <th>Nota</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($dataPerbaikan as $perbaikan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $perbaikan->status }}</td>
                                    <td>{{ $perbaikan->id_report }}</td>
                                    <td>{{ $perbaikan->no_polisi }}</td>
                                    <td>{{ $perbaikan->mitra->nama_mitra }}</td>
                                    <td>{{ $perbaikan->tanggal_perbaikan }}</td>
                                    <td>{{ $perbaikan->tanggal_selesai }}</td>
                                    <td>Rp. {{ number_format($perbaikan->jumlah_pembayaran, 0, ',', '.') }}</td>
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $loop->index }}"> Nota
                                        </button></td>
                                    <td>
                                        <div class="tombol">
                                            <a href="/admin/pdf/perbaikanPDF/{{ $perbaikan->id }}">
                                                <button type="button" class="btn btn-success ">Cetak</button>
                                            </a>
                                            <a href="/admin/updatePerbaikan/{{ $perbaikan->id }}">
                                                <button type="button" class="btn btn-info "
                                                    style="margin-right: 10px; width: 100px">Update</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $loop->index }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"
                                                    style="text-align: center">Nota Perbaikan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body"
                                                style="display: flex; flex-direction: column; margin-bottom: 10px">
                                                @php
                                                    $nota = explode(',', $perbaikan->nota);
                                                @endphp
                                                @if ($perbaikan->nota !== null)
                                                    @foreach ($nota as $not)
                                                        <img src="{{ asset('storage/nota/' . $not) }}" alt=""
                                                            style=" width: 100%; height: 100%; ">
                                                    @endforeach
                                                @else
                                                    <h5 style="text-align: center">Nota Tidak Ada</h5>
                                                @endif

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
