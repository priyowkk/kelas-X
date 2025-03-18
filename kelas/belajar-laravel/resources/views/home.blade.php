@extends('layouts.app')

@section('content')
<div class="container-fluid bg-light py-5">
    <div class="row align-items-center">
        <div class="col-md-6 text-center animate__animated animate__fadeInLeft">
            <h1 class="display-4 fw-bold">Ayam Goreng Jos Gandos</h1>
            <p class="lead">Rasakan sensasi ayam goreng paling jos di kota ini!</p>
            <a href="{{ route('order') }}" class="btn btn-warning btn-lg mt-3">Pesan Sekarang</a>
        </div>
        <div class="col-md-6 animate__animated animate__fadeInRight">
            <img src="https://via.placeholder.com/500x400" class="img-fluid rounded" alt="Ayam Goreng">
        </div>
    </div>
</div>
@endsection