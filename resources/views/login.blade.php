<x-header>
    @slot('title')
        Login
    @endslot
</x-header>

<div class="main-container container-sm ">
    <div class="foto item">
        <img src="{{ asset('asset/truck.png') }}" alt="">
    </div>
    <div class="card-login item">
        <div class="container-sm">
            <div class="title">
                <img src="{{ asset('asset/logo_sbs.png') }}" alt="">
                <span>PT. Satria Bahana Sarana</span>
            </div>

            <div class="isi container">
                <div class="judul">
                    <span class="welcome">Welcome, </span>
                    <span class="subJudul">Pengecekan Perawatan Harian (P2H)</span>
                    <span class="namaPT">PT. Satria Bahana Sarana</span>
                </div>

                @if (session('aksesDitolak'))
                    <div class="alert alert-danger">
                        {{ session('aksesDitolak') }}
                    </div>
                @endif
                @if ($errors->has('error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('error') }}
                    </div>
                @endif

                <form action="/login" method="POST">
                    @csrf
                    <div class="container input">
                        <label for="">Username</label>
                        <input type="text" name="username" id="username" placeholder="Masukan Username" autofocus>
                        <label for="">Password</label>
                        <input type="password" name="password" id="password" placeholder="Masukan Password">
                    </div>

                    <div class="container forgotPassword">

                    </div>

                    <div class="container button">
                        <button type="submit" class="btn btn-success">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<x-footer></x-footer>
