<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem; // Potentially needed for refund logic, but not directly for controller actions
use App\Models\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // For transactions if needed

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('order_number', 'like', $searchTerm)
                  ->orWhereHas('user', function ($uq) use ($searchTerm) {
                      $uq->where('name', 'like', $searchTerm)
                         ->orWhere('email', 'like', $searchTerm);
                  });
            });
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->latest()->paginate(10); // Paginate results

        $statuses = [
            'pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'
        ];

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'refunds']); // Eager load relationships

        $statuses = [
            'pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'
        ];

        return view('admin.orders.show', compact('order', 'statuses'));
    }

    /**
     * Update the status of the specified order.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:pending,processing,shipped,delivered,cancelled,refunded'],
        ]);

        $order->status = $request->status;
        $order->save();

        // Optionally trigger notification to customer
        // Notification::send($order->user, new OrderStatusUpdated($order));

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    /**
     * Process a refund for the specified order.
     */
    public function refund(Request $request, Order $order)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01', 'max:' . $order->total],
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        // Create refund record
        Refund::create([
            'order_id' => $order->id,
            'amount' => $request->amount,
            'reason' => $request->reason,
            'status' => 'processed', // Assuming immediate processing for this simplified version
            'processed_at' => now(),
        ]);

        // Update order payment status
        if ($request->amount == $order->total) {
            $order->payment_status = 'refunded';
            $order->status = 'refunded'; // Also set order status to refunded if full refund
        } else {
            $order->payment_status = 'partial_refund';
            // Order status might remain 'delivered' or 'cancelled' depending on business logic for partial refunds
        }
        $order->save();

        return redirect()->back()->with('success', 'Refund processed successfully.');
    }

    /**
     * Generate a printable packing slip for the specified order.
     */
    public function packingSlip(Order $order)
    {
        $order->load(['user', 'items.product']); // Eager load necessary data

        return view('admin.orders.packing-slip', compact('order'));
    }
}
