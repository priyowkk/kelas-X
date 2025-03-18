@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 animate__animated animate__zoomIn">Pesan Sekarang</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="animate__animated animate__fadeIn">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda">
                </div>
                <div class="mb-3">
                    <label for="menu" class="form-label">Pilih Menu</label>
                    <select class="form-select" id="menu">
                        <option>Ayam Goreng Original - Rp 25.000</option>
                        <option>Ayam Geprek - Rp 30.000</option>
                        <option>Nasi Goreng Ayam - Rp 20.000</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Kirim Pesanan</button>
            </form>
        </div>
    </div>
</div>
@endsection