@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1>Orders</h1>
        <p class="text-muted">Review and manage customer orders.</p>
    </div>
    <a href="{{ route('orders.create') }}" class="btn btn-success">Create New Order</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Order ID</th>
                <th>Rice</th>
                <th>Quantity (kg)</th>
                <th>Price / kg</th>
                <th>Total</th>
                <th>Date</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->rice->name }}</td>
                    <td>{{ number_format($order->quantity, 2) }}</td>
                    <td>{{ number_format($order->price, 2) }}</td>
                    <td>{{ number_format($order->total_amount, 2) }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td><a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary">View</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
