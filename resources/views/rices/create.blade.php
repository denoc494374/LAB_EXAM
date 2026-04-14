@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-4">Add Rice Product</h1>

                <form method="POST" action="{{ route('rices.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Rice Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price per Kilogram</label>
                        <input type="number" step="0.01" name="price_per_kg" value="{{ old('price_per_kg') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" step="0.01" name="stock_quantity" value="{{ old('stock_quantity') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Save Rice</button>
                    <a href="{{ route('rices.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
