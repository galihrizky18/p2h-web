@extends('layout.formLayout')

<x-header>
    @slot('title')
        Form || PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')
    <div class="body">
        <div class="halaman-driver-document halaman-driver">
            <div class="judul">
                <span>Document</span>
            </div>

            <form action="/driver/form/document" method="POST">
                @csrf
                <div class="detail-unit">
                    <div class="kolom1 kolom">
                        <table>
                            <tr>
                                <td>
                                    Shift
                                </td>
                                <td>:</td>
                                <td>
                                    <select  name="shift" id="shift" class="@error('shift') is-invalid @enderror">
                                        <option value="">--Shift--</option>
                                        <option value="shift_1" {{ old('shift') === 'shift_1' ? 'selected' : '' }}>Shift 1</option>
                                        <option value="shift_2" {{ old('shift') === 'shift_1' ? 'selected' : '' }}>Shift 2</option>
                                    </select>
                                    @error('shift')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tanggal Pemeriksaan
                                </td>
                                <td>:</td>
                                <td>
                                    <input type="date" name="tanggal_pemeriksan" id="tanggal_pemeriksaan" class="@error('tanggal_pemeriksan') is-invalid @enderror" value="{{ old('tanggal_pemeriksan') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Unit
                                </td>
                                <td>:</td>
                                <td>
                                    <select  name="no_unit" id="no_unit">
                                        <option value="">--Unit--</option>
                                        @foreach ($dataUnit as $unit)
                                            <option value="{{ $unit->no_polisi }}" {{ old('no_unit') === $unit->no_polisi ? 'selected' : '' }}>{{ $unit->merk_mobil }} {{ $unit->model_mobil }}</option>
                                        @endforeach
                                    </select>
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
                                    <input type="number" name="fuel" id="fuel" value="{{ old('fuel') }}">
                                </td>
                                <td>Km / l</td>
                            </tr>
                            <tr>
                                <td>
                                    Kilometer Awal
                                </td>
                                <td>:</td>
                                <td>
                                    <input type="number" name="km_awal" id="km_awal" value="{{ old('km_awal') }}">
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
                            @csrf
                            @foreach ($pertanyaan as $p)
                                <tr>
                                    <td>{{ $p->pertanyaan }}</td>
                                    <td>
                                        <input type="radio" id="jawaban" name="jawaban_{{ $p->id }}" value="benar" {{ old('jawaban_' . $p->id) === 'benar' ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="radio" id="jawaban" name="jawaban_{{ $p->id }}" value="salah" {{ old('jawaban_' . $p->id) === 'salah' ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan_{{ $p->id }}" id="keterangan" value="{{ $p->keterangan ?? '' }}" value="{{ old('keterangan_' . $p->id, $p->keterangan ?? '') }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tombol">
                    
                    <a href="">
                        <button type="submit" class="btn btn-success">Next</button>
                    </a>
                </div>
            </form>



        </div>
    </div>
@endsection