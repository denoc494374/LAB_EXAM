<?php

namespace App\Http\Controllers;

use App\Models\Rice;
use Illuminate\Http\Request;

class RiceController extends Controller
{
    public function index()
    {
        $rices = Rice::orderBy('name')->get();

        return view('rices.index', compact('rices'));
    }

    public function create()
    {
        return view('rices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price_per_kg' => ['required', 'numeric', 'min:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        Rice::create($request->only(['name', 'price_per_kg', 'stock_quantity', 'description']));

        return redirect()->route('rices.index')->with('success', 'Rice product added successfully.');
    }

    public function edit(Rice $rice)
    {
        return view('rices.edit', compact('rice'));
    }

    public function update(Request $request, Rice $rice)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price_per_kg' => ['required', 'numeric', 'min:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        $rice->update($request->only(['name', 'price_per_kg', 'stock_quantity', 'description']));

        return redirect()->route('rices.index')->with('success', 'Rice product updated successfully.');
    }

    public function destroy(Rice $rice)
    {
        $rice->delete();

        return redirect()->route('rices.index')->with('success', 'Rice product removed successfully.');
    }
}
