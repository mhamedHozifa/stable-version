@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Order Details - #{{ $order->order_number }}</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Order Information</h6>
                </div>
                <div class="card-body">
                    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                    <p><strong>Status:</strong> {!! $order->status_badge !!}</p>
                    <p><strong>Payment Status:</strong> <span class="badge bg-secondary">{{ ucfirst($order->payment_status) }}</span></p>
                    <p><strong>Total Amount:</strong> {{ $order->formatted_total }}</p>
                    <p><strong>Ordered On:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
                    <p><strong>Customer:</strong>
                        @if ($order->user)
                            <a href="mailto:{{ $order->user->email }}">{{ $order->user->name }} ({{ $order->user->email }})</a>
                        @else
                            Guest User
                        @endif
                    </p>
                    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                    <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
                    @if ($order->billing_address)
                        <p><strong>Billing Address:</strong> {{ $order->billing_address }}</p>
                    @endif
                    @if ($order->notes)
                        <p><strong>Notes:</strong> {{ $order->notes }}</p>
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Order Items</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        @if($item->product)
                                            <a href="{{ route('shop.products.show', $item->product) }}" target="_blank">{{ $item->product_name }}</a>
                                        @else
                                            {{ $item->product_name }}
                                        @endif
                                    </td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->total, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Order Subtotal:</th>
                                    <th>${{ number_format($order->items->sum('total'), 2) }}</th>
                                </tr>
                                {{-- Assuming total includes shipping/taxes, this part might need adjustment --}}
                                <tr>
                                    <th colspan="3" class="text-right">Grand Total:</th>
                                    <th>{{ $order->formatted_total }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            @if ($order->refunds->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Refund History</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Refund Amount</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Processed On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->refunds as $refund)
                                <tr>
                                    <td>${{ number_format($refund->amount, 2) }}</td>
                                    <td>{{ $refund->reason ?? 'N/A' }}</td>
                                    <td><span class="badge bg-info">{{ ucfirst($refund->status) }}</span></td>
                                    <td>{{ $refund->processed_at ? $refund->processed_at->format('M d, Y H:i') : 'Pending' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
                </div>
                <div class="card-body">
                    <h5 class="mb-3">Update Order Status</h5>
                    <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="status">Change Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Update Status</button>
                    </form>

                    <hr>

                    <h5 class="mb-3">Process Refund</h5>
                    <form action="{{ route('admin.orders.refund', $order) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="refund_amount">Refund Amount</label>
                            <input type="number" name="amount" id="refund_amount" class="form-control @error('amount') is-invalid @enderror" step="0.01" min="0.01" max="{{ $order->total - $order->refunds->sum('amount') }}" placeholder="e.g., {{ number_format($order->total, 2) }}" required>
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="refund_reason">Reason (Optional)</label>
                            <textarea name="reason" id="refund_reason" class="form-control @error('reason') is-invalid @enderror" rows="3"></textarea>
                            @error('reason')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-warning btn-block" {{ $order->payment_status == 'refunded' ? 'disabled' : '' }}>Process Refund</button>
                    </form>

                    <hr>

                    <a href="{{ route('admin.orders.packing-slip', $order) }}" target="_blank" class="btn btn-secondary btn-block">Print Packing Slip</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
