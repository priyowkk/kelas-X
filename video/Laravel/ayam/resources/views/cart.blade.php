@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Your Cart</h1>
    
    @if(session('cart') && count(session('cart')) > 0)
    <div class="row">
        <div class="col-md-8">
            @foreach(session('cart') as $id => $item)
            <div class="cart-item d-flex align-items-center">
                <img src="{{ asset('storage/' . $item['image']) }}" class="cart-img me-3" alt="{{ $item['name'] }}">
                <div class="flex-grow-1">
                    <h5>{{ $item['name'] }}</h5>
                    <p class="mb-0">Rp {{ number_format($item['price']) }}</p>
                </div>
                <div class="d-flex align-items-center">
                    <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center me-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="10" class="form-control form-control-sm me-2" style="width: 60px;">
                        <button type="submit" class="btn btn-sm btn-primary-custom">Update</button>
                    </form>
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-secondary-custom text-primary-custom">
                    <h4 class="mb-0">Order Summary</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach(session('cart') as $id => $item)
                                @php $total += $item['price'] * $item['quantity'] @endphp
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['quantity'] }} x</td>
                                    <td class="text-end">Rp {{ number_format($item['price'] * $item['quantity']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total:</th>
                                <th class="text-end">Rp {{ number_format($total) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    <a href="{{ route('checkout') }}" class="btn btn-primary-custom w-100">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-info">
        <p>Your cart is empty! <a href="{{ route('menu') }}">Continue shopping</a></p>
    </div>
    @endif
</div>
@endsection