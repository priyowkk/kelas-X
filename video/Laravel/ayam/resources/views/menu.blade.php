@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Our Menu</h1>
    
    @foreach($categories as $category)
    <div class="mb-5">
        <h2 class="mb-4">{{ $category->name }}</h2>
        <div class="row">
            @foreach($category->products as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card h-100">
                    @if($product->is_promo)
                    <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1">
                        {{ $product->discount_percentage }}% OFF
                    </div>
                    @endif
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-img" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
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
    @endforeach
</div>
@endsection