@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Checkout</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h5 class="mb-3">Order Summary</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>{{ $item['product']->name }}</td>
                                    <td>${{ number_format($item['product']->price, 2) }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>${{ number_format($item['subtotal'], 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Total:</th>
                                    <th>${{ number_format($total, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <hr>

                    <form method="POST" action="{{ route('checkout.process') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" required value="{{ old('address') }}">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control" required value="{{ old('city') }}">
                            @error('city')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control" required value="{{ old('state') }}">
                            @error('state')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="zip">Zip</label>
                            <input type="text" name="zip" id="zip" class="form-control" required value="{{ old('zip') }}">
                            @error('zip')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country" class="form-control" required value="{{ old('country') }}" maxlength="2">
                            @error('country')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">ادفع الآن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection