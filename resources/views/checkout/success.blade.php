@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Successful</div>

                <div class="card-body text-center">
                    <h4 class="text-success">تم الدفع بنجاح</h4>
                    <p>Thank you for your purchase! Your order has been processed successfully.</p>
                    <a href="{{ route('cart.index') }}" class="btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection