<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packing Slip - Order #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20mm;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #000;
        }
        .details, .items {
            margin-bottom: 30px;
        }
        .details h2, .items h2 {
            font-size: 1.2em;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .details p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th, table td {
            border: 1px solid #eee;
            padding: 8px 12px;
            text-align: left;
        }
        table th {
            background-color: #f9f9f9;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            font-size: 0.8em;
            color: #777;
        }

        /* Print-specific styles */
        @media print {
            body {
                margin: 0;
                -webkit-print-color-adjust: exact; /* For better background/color printing */
            }
            .container {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Packing Slip</h1>
            <p><strong>Order #{{ $order->order_number }}</strong></p>
            <p>Date: {{ $order->created_at->format('M d, Y') }}</p>
        </div>

        <div class="details">
            <h2>Shipping Information</h2>
            <p><strong>Customer Name:</strong> {{ $order->user ? $order->user->name : 'Guest User' }}</p>
            <p><strong>Shipping Address:</strong><br>{{ nl2br($order->shipping_address) }}</p>
        </div>

        <div class="items">
            <h2>Items</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>123 Commerce St, Suite 100, City, Province, Postal Code</p>
        </div>
    </div>
</body>
</html>
