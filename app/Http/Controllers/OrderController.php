<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Designer;
use App\Models\Master;
use App\Models\MastersGroup;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use ReflectionClass;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('orders.index', [
            'orders' => Order::all(),
            'clients' => Client::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required',
            'name' => 'required',
            'deadline' => 'required',
        ]);
        // dd($validated);
        Order::create([
            'client_id' => $validated['client_id'],
            'name' => $validated['name'],
            'desc' => $request['desc'],
            'deadline' => $validated['deadline'],
            'created_at' => now(),
        ]);
        return redirect()->route('clients.show', $request->client_id)->with('success', 'Order created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('clients.orders.show', [
            'order' => $order,
            'services' => Service::all(),
            'masters_groups' => MastersGroup::all(),
            'designers' => Designer::all(),
            'masters_type' => MastersGroup::class,
            'designers_type' => Designer::class
        ]);
    }

    public function edit(Order $order)
    {
        return view('orders.edit', [
            'order' => $order,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'name' => 'required',
            'desc' => 'nullable',
            'deadline' => 'required',
            'status' => 'required',
            'updated_at' => now(),
        ]);

        $order->update($validated);
        return redirect()->route('orders.index', [
            'orders' => Order::all(),
            'clients' => Client::all(),
        ])->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('clients.show', $order->client_id)->with('success', 'Order deleted successfully');
    }

    public function storeServices(Request $request, Order $order)
    {
        if (isset(json_decode($request->orderable)->user_id)) {
            $order->services()->attach($request['service_id'], [
                'price' => $request['price'],
                'width' => $request['width'] ?? null,
                'height' => $request['height'] ?? null,
                'quantity' => $request['quantity'],
                'orderable_id' => json_decode($request->orderable)->id,
                'orderable_type' => Designer::class,
                'created_at' => now(),
            ]);
        } else {
            $order->services()->attach($request['service_id'], [
                'price' => $request['price'],
                'width' => $request['width'] ?? null,
                'height' => $request['height'] ?? null,
                'quantity' => $request['quantity'],
                'orderable_id' => json_decode($request->orderable)->id,
                'orderable_type' => MastersGroup::class,
                'created_at' => now(),
            ]);
        }

        return redirect()->route('orders.show', $order)->with('success', 'Service added successfully');
    }

    public function destroyService(Request $request, Order $order)
    {
        $orderService = OrderService::find($request->pivot_id);
        $orderService->delete();
        return redirect()->route('orders.show', $order)->with('success', 'Service deleted successfully');
    }
}
