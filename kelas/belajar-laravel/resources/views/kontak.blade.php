@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 animate__animated animate__zoomIn">Hubungi Kami</h2>
    <div class="row">
        <div class="col-md-6 animate__animated animate__fadeInLeft">
            <p><strong>Alamat:</strong> Jl. Jos Gandos No. 123, Jakarta</p>
            <p><strong>Telepon:</strong> 0812-3456-7890</p>
            <p><strong>Email:</strong> info@josgandos.com</p>
        </div>
        <div class="col-md-6 animate__animated animate__fadeInRight">
            <iframe src="https://www.google.com/maps/embed?pb=" class="w-100" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>
@endsection