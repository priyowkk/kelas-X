@extends('layouts.app')

@section('content')
<div class="banner" style="background-image: url('{{ asset('images/banner.jpg') }}');">
    <div class="banner-content">
        <h1 class="display-4 fw-bold">Crispy & Delicious</h1>
        <p class="lead">Experience the best fried chicken in town!</p>
        <a href="{{ route('menu') }}" class="btn btn-primary-custom btn-lg">View Menu</a>
    </div>
</div>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row">
            @foreach($featuredProducts as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-img" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text fw-bold">
                            @if($product->is_promo)
                            <span class="text-decoration-line-through text-muted">Rp {{ number_format($product->price) }}</span>
                            <span class="text-danger">Rp {{ number_format($product->getDiscountedPrice()) }}</span>
                            @else
                            <span>Rp {{ number_format($product->price) }}</span>
                            @endif
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary-custom">Buy</a>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-outline-dark">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5 bg-secondary-custom text-primary-custom">
    <div class="container">
        <h2 class="text-center mb-4">Special Promotions</h2>
        <div class="row">
            @foreach($promoProducts as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card h-100">
                    <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1">
                        {{ $product->discount_percentage }}% OFF
                    </div>
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-img" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text fw-bold">
                            <span class="text-decoration-line-through text-muted">Rp {{ number_format($product->price) }}</span>
                            <span class="text-danger">Rp {{ number_format($product->getDiscountedPrice()) }}</span>
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary-custom">Buy</a>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-outline-dark">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection