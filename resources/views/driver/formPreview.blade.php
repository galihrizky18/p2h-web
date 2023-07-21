@extends('layout.formLayout')

<x-header>
    @slot('title')
        Form || PT. Satria Bahana Sarana
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
                                    {{ $documentData['shift'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tanggal Pemeriksaan
                                </td>
                                <td>:</td>
                                <td>
                                    {{ $documentData['tanggal_pemeriksan'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Unit
                                </td>
                                <td>:</td>
                                <td>
                                    {{ $documentData['no_unit'] }}
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
                                    {{ $documentData['fuel'] }}
                                </td>
                                <td>Km / l</td>
                            </tr>
                            <tr>
                                <td>
                                    Kilometer Awal
                                </td>
                                <td>:</td>
                                <td>
                                    {{ $documentData['km_awal'] }}
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
                                        @if ($documentData["jawaban_".$p->id] == 'benar')
                                            <img src="{{ asset('asset/check.svg') }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($documentData["jawaban_".$p->id] == 'salah')
                                            <img src="{{ asset('asset/wrong.svg') }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan" id="keterangan" value="{{ $documentData["keterangan_".$p->id] }}" readonly>
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
                                        @if ($safetyeData["jawaban_".$p->id] == 'benar')
                                        <img src="{{ asset('asset/check.svg') }}" alt="">
                                    @endif
                                    </td>
                                    <td>
                                        @if ($safetyeData["jawaban_".$p->id] == 'salah')
                                            <img src="{{ asset('asset/wrong.svg') }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan" id="keterangan" value="{{ $safetyeData["keterangan_".$p->id] }}" readonly>
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
                                        @if ($engineData["jawaban_".$p->id] == 'benar')
                                        <img src="{{ asset('asset/check.svg') }}" alt="">
                                    @endif
                                    </td>
                                    <td>
                                        @if ($engineData["jawaban_".$p->id] == 'salah')
                                            <img src="{{ asset('asset/wrong.svg') }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan" id="keterangan" value="{{ $engineData["keterangan_".$p->id] }}" readonly>
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
                                        @if ($toolsData["jawaban_".$p->id] == 'benar')
                                        <img src="{{ asset('asset/check.svg') }}" alt="">
                                    @endif
                                    </td>
                                    <td>
                                        @if ($toolsData["jawaban_".$p->id] == 'salah')
                                            <img src="{{ asset('asset/wrong.svg') }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan" id="keterangan" value="{{ $toolsData["keterangan_".$p->id] }}" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="tombol">
                <a href="/driver/form/tools">
                    <button type="button" class="btn btn-warning">Back</button>
                </a>
                <a href="/driver/form/storeDatabase">
                    <button type="button" class="btn btn-success">Save</button>
                </a>
            </div>
        </div>
    </div>
@endsection