@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 animate__animated animate__zoomIn">Chat dengan Kami</h2>
    <div class="card animate__animated animate__fadeIn">
        <div class="card-body">
            <div class="chat-box" style="height: 300px; overflow-y: scroll; border: 1px solid #ddd; padding: 10px;">
                <p>Selamat datang! Silakan kirim pesan.</p>
            </div>
            <form class="mt-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Ketik pesan Anda...">
                    <button class="btn btn-primary" type="button">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection