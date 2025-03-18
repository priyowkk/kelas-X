@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 animate__animated animate__zoomIn">Daftar Menu</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card animate__animated animate__fadeInUp">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Ayam Goreng">
                <div class="card-body">
                    <h5 class="card-title">Ayam Goreng Original</h5>
                    <p class="card-text">Rp 25.000</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card animate__animated animate__fadeInUp animate__delay-1s">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Ayam Geprek">
                <div class="card-body">
                    <h5 class="card-title">Ayam Geprek</h5>
                    <p class="card-text">Rp 30.000</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card animate__animated animate__fadeInUp animate__delay-2s">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Nasi Goreng">
                <div class="card-body">
                    <h5 class="card-title">Nasi Goreng Ayam</h5>
                    <p class="card-text">Rp 20.000</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection