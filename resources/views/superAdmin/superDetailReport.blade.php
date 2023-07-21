@extends('layout.superAdminLayout')

<x-header>
    @slot('title')
        Report Form | PT.Satria Bahana Sara
    @endslot
</x-header>

@section('body')
    <div class="body">
        <div class="halaman-preview-form">
            <div class="document judulHalaman">
                <div class="judul">
                    <span>Document</span>
                </div>
                <div class="detail-unit">
                    <div class="kolom1 kolom">
                        <table>
                            <tr>
                                <td>
                                    Shift
                                </td>
                                <td>:</td>
                                <td>
                                    {{ $dataDocument['shift'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tanggal Pemeriksaan
                                </td>
                                <td>:</td>
                                <td>
                                    {{ $dataDocument['tgl_pemeriksaan'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Unit
                                </td>
                                <td>:</td>
                                <td>
                                    {{ $dataDocument['no_polisi'] }}
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="kolom2 kolom">
                        <table>
                            <tr>
                                <td>
                                    Fuel
                                </td>
                                <td>:</td>
                                <td>
                                    {{ $dataDocument['fuel'] }}
                                </td>
                                <td>Km / l</td>
                            </tr>
                            <tr>
                                <td>
                                    Kilometer Awal
                                </td>
                                <td>:</td>
                                <td>
                                    {{ $dataDocument['km_awal'] }}
                                </td>
                                <td>Km</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="isi-form">
                    <table>
                        <thead>
                            <tr>
                                <th width="500px">ITEM</th>
                                <th width="50px"><img src="{{ asset('asset/correct-icon.svg') }}" alt=""></th>
                                <th width="50px"><img src="{{ asset('asset/wrong-icon.svg') }}" alt=""></th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pertanyaanDocument as $p)
                                <tr>
                                    <td>{{ $p->pertanyaan }}</td>
                                    <td>
                                        @if ($dataDocument["pertanyaan_".$p->id] == 'benar')
                                            <img src="{{ asset('asset/check.svg') }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($dataDocument["pertanyaan_".$p->id] == 'salah')
                                            <img src="{{ asset('asset/wrong.svg') }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan" id="keterangan" value="{{ $dataDocument["keterangan_".$p->id] }}" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="safety judulHalaman">
                <div class="judul">
                    <span>Safety</span>
                </div>

                <div class="isi-form">
                    <table>
                        <thead>
                            <tr>
                                <th width="500px">ITEM</th>
                                <th width="50px"><img src="{{ asset('asset/correct-icon.svg') }}" alt=""></th>
                                <th width="50px"><img src="{{ asset('asset/wrong-icon.svg') }}" alt=""></th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pertanyaanSafety as $p)
                                <tr>
                                    <td>{{ $p->pertanyaan }}</td>
                                    <td>
                                        @if ($dataSafety["pertanyaan_".$p->id] == 'benar')
                                        <img src="{{ asset('asset/check.svg') }}" alt="">
                                    @endif
                                    </td>
                                    <td>
                                        @if ($dataSafety["pertanyaan_".$p->id] == 'salah')
                                            <img src="{{ asset('asset/wrong.svg') }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan" id="keterangan" value="{{ $dataSafety["keterangan_".$p->id] }}" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="engine judulHalaman">
                <div class="judul">
                    <span>Engine</span>
                </div>

                <div class="isi-form">
                    <table>
                        <thead>
                            <tr>
                                <th width="500px">ITEM</th>
                                <th width="50px"><img src="{{ asset('asset/correct-icon.svg') }}" alt=""></th>
                                <th width="50px"><img src="{{ asset('asset/wrong-icon.svg') }}" alt=""></th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pertanyaanEngine as $p)
                                <tr>
                                    <td>{{ $p->pertanyaan }}</td>
                                    <td>
                                        @if ($dataEngine["pertanyaan_".$p->id] == 'benar')
                                        <img src="{{ asset('asset/check.svg') }}" alt="">
                                    @endif
                                    </td>
                                    <td>
                                        @if ($dataEngine["pertanyaan_".$p->id] == 'salah')
                                            <img src="{{ asset('asset/wrong.svg') }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan" id="keterangan" value="{{ $dataEngine["keterangan_".$p->id] }}" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tools judulHalaman">
                <div class="judul">
                    <span>Tools</span>
                </div>

                <div class="isi-form">
                    <table>
                        <thead>
                            <tr>
                                <th width="500px">ITEM</th>
                                <th width="50px"><img src="{{ asset('asset/correct-icon.svg') }}" alt=""></th>
                                <th width="50px"><img src="{{ asset('asset/wrong-icon.svg') }}" alt=""></th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pertanyaanTools as $p)
                                <tr>
                                    <td>{{ $p->pertanyaan }}</td>
                                    <td>
                                        @if ($dataTools["pertanyaan_".$p->id] == 'benar')
                                        <img src="{{ asset('asset/check.svg') }}" alt="">
                                    @endif
                                    </td>
                                    <td>
                                        @if ($dataTools["pertanyaan_".$p->id] == 'salah')
                                            <img src="{{ asset('asset/wrong.svg') }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan" id="keterangan" value="{{ $dataTools["keterangan_".$p->id] }}" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="tombol">
                <a href="/super-admin/reportForm">
                    <button type="button" class="btn btn-warning">Back</button>
                </a>
                <a href="/super-admin/inputPerbaikan/{{ $dataReport->id }}">
                    <button type="button" class="btn btn-success">Perbaiki</button>
                </a>
            </div>
        </div>
    </div>
@endsection
