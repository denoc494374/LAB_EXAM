@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div>
                <h1 class="h4">Order #{{ $order->id }}</h1>
                <p class="text-muted">Order details and pricing summary.</p>
            </div>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <h5>Rice</h5>
                <p>{{ $order->rice->name }}</p>
            </div>
            <div class="col-md-6">
                <h5>Customer</h5>
                <p>{{ $order->customer_name ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <h6>Quantity</h6>
                <p>{{ number_format($order->quantity, 2) }} kg</p>
            </div>
            <div class="col-md-4">
                <h6>Price / kg</h6>
                <p>{{ number_format($order->price, 2) }}</p>
            </div>
            <div class="col-md-4">
                <h6>Total</h6>
                <p>{{ number_format($order->total_amount, 2) }}</p>
            </div>
        </div>

        <div class="mb-3">
            <h5>Payment</h5>
            @if($order->payment)
                <p>Status: <strong>{{ $order->payment->status }}</strong></p>
                <p>Amount Paid: {{ number_format($order->payment->amount, 2) }}</p>
                <p>Paid At: {{ $order->payment->paid_at?->format('Y-m-d H:i') ?? 'N/A' }}</p>
                <p>Notes: {{ $order->payment->notes ?? 'None' }}</p>
            @else
                <p>No payment has been recorded for this order yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
