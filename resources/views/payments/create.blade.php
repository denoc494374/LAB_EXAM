@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-4">Record Payment</h1>

                <form method="POST" action="{{ route('payments.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <select name="order_id" class="form-select" required>
                            <option value="">Select order</option>
                            @foreach($orders as $order)
                                <option value="{{ $order->id }}" {{ old('order_id') == $order->id ? 'selected' : '' }}>
                                    Order #{{ $order->id }} — {{ $order->rice->name }} — Total {{ number_format($order->total_amount, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Amount Paid</label>
                        <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Paid" {{ old('status') === 'Paid' ? 'selected' : '' }}>Paid</option>
                            <option value="Unpaid" {{ old('status') === 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Save Payment</button>
                    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
