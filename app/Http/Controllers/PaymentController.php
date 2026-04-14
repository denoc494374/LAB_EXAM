<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order.rice')->latest()->get();

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Order::with('rice')->orderBy('created_at', 'desc')->get();

        return view('payments.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => ['required', 'exists:orders,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:Paid,Unpaid'],
            'notes' => ['nullable', 'string'],
        ]);

        Payment::create([
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'status' => $request->status,
            'paid_at' => $request->status === 'Paid' ? now() : null,
            'notes' => $request->notes,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment transaction recorded successfully.');
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:Paid,Unpaid'],
            'notes' => ['nullable', 'string'],
        ]);

        $payment->update([
            'amount' => $request->amount,
            'status' => $request->status,
            'paid_at' => $request->status === 'Paid' ? now() : null,
            'notes' => $request->notes,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment status updated successfully.');
    }
}
