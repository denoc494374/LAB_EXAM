@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1>Rice Menu</h1>
        <p class="text-muted">Manage rice products, prices, stock, and descriptions.</p>
    </div>
    <a href="{{ route('rices.create') }}" class="btn btn-success">Add New Rice</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Price / kg</th>
                <th>Stock</th>
                <th>Description</th>
                <th width="180">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rices as $rice)
                <tr>
                    <td>{{ $rice->name }}</td>
                    <td>{{ number_format($rice->price_per_kg, 2) }}</td>
                    <td>{{ number_format($rice->stock_quantity, 2) }}</td>
                    <td>{{ $rice->description }}</td>
                    <td>
                        <a href="{{ route('rices.edit', $rice) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('rices.destroy', $rice) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this rice product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No rice products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
