@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1>Payments</h1>
        <p class="text-muted">View the payment history and update transaction status.</p>
    </div>
    <a href="{{ route('payments.create') }}" class="btn btn-success">Record Payment</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Order</th>
                <th>Rice</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Paid At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->order->id }}</td>
                    <td>{{ $payment->order->rice->name }}</td>
                    <td>{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>{{ $payment->paid_at?->format('Y-m-d') ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-primary">Update</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No payment records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
