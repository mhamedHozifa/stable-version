@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Cancelled</div>

                <div class="card-body text-center">
                    <h4 class="text-warning">تم إلغاء الدفع</h4>
                    <p>Your payment was cancelled. You can try again or continue shopping.</p>
                    <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Try Again</a>
                    <a href="{{ route('cart.index') }}" class="btn btn-secondary">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection