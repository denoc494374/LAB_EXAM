<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rice;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('rice')->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $rices = Rice::where('stock_quantity', '>', 0)->orderBy('name')->get();

        return view('orders.create', compact('rices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => ['nullable', 'string', 'max:255'],
            'rice_id' => ['required', 'exists:rices,id'],
            'quantity' => ['required', 'numeric', 'min:0.1'],
        ]);

        $rice = Rice::findOrFail($request->rice_id);

        if ($request->quantity > $rice->stock_quantity) {
            return back()->withErrors(['quantity' => 'Quantity cannot exceed stock available.'])->withInput();
        }

        $price = $rice->price_per_kg;
        $total = round($price * $request->quantity, 2);

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'rice_id' => $rice->id,
            'quantity' => $request->quantity,
            'price' => $price,
            'total_amount' => $total,
        ]);

        $rice->decrement('stock_quantity', $request->quantity);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load('rice', 'payment');

        return view('orders.show', compact('order'));
    }
}
