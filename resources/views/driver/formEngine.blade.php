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
                <span>Engine</span>
            </div>

            <form action="/driver/form/engine" method="POST">
                @csrf
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
                            @foreach ($pertanyaan as $p)
                                <tr>
                                    <td>{{ $p->pertanyaan }}</td>
                                    <td>
                                        <input type="radio" id="jawaban" name="jawaban_{{ $p->id }}" value="benar">
                                    </td>
                                    <td>
                                        <input type="radio" id="jawaban" name="jawaban_{{ $p->id }}" value="salah">
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan_{{ $p->id }}" id="keterangan" value="{{ $p->keterangan ?? '' }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tombol">
                    <a href="/driver/form/safety">
                        <button type="button" class="btn btn-warning">Back</button>
                    </a>
                    <a href="">
                        <button type="submit" class="btn btn-success">Next</button>
                    </a>
                </div>
            </form>



        </div>
    </div>
@endsection