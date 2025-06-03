@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Checkout</h1>
    
    <div class="row">
        <div class="col-md-8"> <div class="card shadow mb-4">
            <div class="card-header bg-secondary-custom text-primary-custom">
                <h4 class="mb-0">Shipping Information</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="shipping_address" class="form-label">Shipping Address</label>
                        <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required>{{ auth()->user()->address }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="cod">Cash on Delivery</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="e_wallet">E-Wallet</option>
                        </select>
                    </div>
            </div>
        </div>
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
                            <th colspan="2">Subtotal:</th>
                            <th class="text-end">Rp {{ number_format($total) }}</th>
                        </tr>
                        <tr>
                            <td>Delivery Fee:</td>
                            <td></td>
                            <td class="text-end">Rp {{ number_format(10000) }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Total:</th>
                            <th class="text-end">Rp {{ number_format($total + 10000) }}</th>
                        </tr>
                    </tfoot>
                </table>
                <button type="submit" class="btn btn-primary-custom w-100">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection