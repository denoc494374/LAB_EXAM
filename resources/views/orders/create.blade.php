@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-4">Create Order</h1>

                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Customer Name</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rice Item</label>
                        <select name="rice_id" class="form-select" required>
                            <option value="">Select rice</option>
                            @foreach($rices as $rice)
                                <option value="{{ $rice->id }}" {{ old('rice_id') == $rice->id ? 'selected' : '' }}>
                                    {{ $rice->name }} — {{ number_format($rice->price_per_kg, 2) }} / kg ({{ number_format($rice->stock_quantity, 2) }} kg available)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity (kg)</label>
                        <input type="number" step="0.01" name="quantity" value="{{ old('quantity') }}" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Save Order</button>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
