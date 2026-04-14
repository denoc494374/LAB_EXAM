@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-4">Update Payment</h1>

                <form method="POST" action="{{ route('payments.update', $payment) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="text" class="form-control" value="Order #{{ $payment->order->id }} — {{ $payment->order->rice->name }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Amount Paid</label>
                        <input type="number" step="0.01" name="amount" value="{{ old('amount', $payment->amount) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Paid" {{ old('status', $payment->status) === 'Paid' ? 'selected' : '' }}>Paid</option>
                            <option value="Unpaid" {{ old('status', $payment->status) === 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes', $payment->notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Payment</button>
                    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
