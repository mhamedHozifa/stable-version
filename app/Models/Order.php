<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'total',
        'shipping_address',
        'billing_address',
        'payment_method',
        'payment_status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }

    // Accessor for formatted total
    public function getFormattedTotalAttribute()
    {
        return '$' . number_format($this->total, 2);
    }

    // Example for status badge (can be expanded with more logic)
    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return '<span class="badge bg-warning text-dark">Pending</span>';
            case 'processing':
                return '<span class="badge bg-info">Processing</span>';
            case 'shipped':
                return '<span class="badge bg-primary">Shipped</span>';
            case 'delivered':
                return '<span class="badge bg-success">Delivered</span>';
            case 'cancelled':
                return '<span class="badge bg-danger">Cancelled</span>';
            case 'refunded':
                return '<span class="badge bg-dark">Refunded</span>';
            default:
                return '<span class="badge bg-secondary">' . ucfirst($this->status) . '</span>';
        }
    }
}
