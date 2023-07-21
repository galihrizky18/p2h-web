@extends('layout.driverLayout')

<x-header>
    @slot('title')
        Dashboard || PT. Satria Bahana Sarana
    @endslot
</x-header>

@section('body')
    <div class="body">
        <div class="halaman-driver-dashboard">
            <div class="judul-halaman">
                <div class="container1 kolom">
                    Welcome Garix
                </div>
                <div class="container2 kolom">
                    <div class="username ">
                        Galih Rizky
                    </div>
                    <div class="gambar">
                        <img src="{{ asset('asset/admin/profile-icon.svg') }}" alt="">
                    </div>
                </div>
            </div>

            <div class="isi-halaman">
                    <div class="personal-information">
                    <div class="container1">
                        <img src="{{ asset('asset/profile-icon.svg') }}" alt="">
                        <div class="detail">
                            <span >Galih Rizky</span>
                            <span >username</span>
                        </div>
                    </div>

                    <div class="container2">
                        <div class="item1 kolom">
                            <label for="">Nama Depan</label>
                            <span>Galih</span>
                        </div>
                        <div class="item2 kolom">
                            <label for="">Nama Belakang</label>
                            <span>Rizky</span>
                        </div>
                        <div class="item3 kolom">
                            <label for="">Jenis Kelamin</label>
                            <span>Laki - Laki</span>
                        </div>
                        <div class="item4 kolom">
                            <label for="">Tempat, Tanggal Lahir</label>
                            <span>LubukLinggau, 18 Februari 2002</span>
                        </div>
                        <div class="item5 kolom">
                            <label for="">Kota Domisili</label>
                            <span>Palembang</span>
                        </div>
                        <div class="item6 kolom">
                            <label for="">Kode Pos</label>
                            <span>1234</span>
                        </div>
                        <div class="item7 kolom">
                            <label for="">Kebangsaan</label>
                            <span>Indonesia</span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection