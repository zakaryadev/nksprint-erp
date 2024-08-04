<?php

namespace App\Http\Controllers;

use App\Models\ArrivedProduct;
use App\Models\DecommissionedProduct;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', [
            'products' => Product::all(),
            'units' => Unit::all()
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'unit_id' => 'required',
            'unit_price' => 'required',
            'quantity' => 'required'
        ]);
        Product::create($validated);
        return redirect()->route('products.index', [
            'products' => Product::all(),
            'units' => Unit::all()
        ])->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
            'units' => Unit::all()
        ])->with('success', 'Product updated successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'unit_id' => 'required',
            // 'unit_price' => 'required',
            // 'quantity' => 'required'
        ]);
        $product->update($validated);
        return redirect()->route('products.index', [
            'products' => Product::all(),
            'units' => Unit::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index', [
            'products' => Product::all(),
            'units' => Unit::all()
        ])->with('success', 'Product deleted successfully');
    }

    public function arrive(Product $product)
    {
        return view('products.arrive', [
            'product' => $product,
            'units' => Unit::all(),
            'providers' => Provider::all()
        ]);
    }

    public function storeArrive(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required',
            'unit_id' => 'required',
            'unit_price' => 'required',
            'provider_id' => 'required'
        ]);
        ArrivedProduct::create([
            'provider_id' => $request->provider_id,
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'unit_id' => $validated['unit_id'],
            'unit_price' => $validated['unit_price'],
        ]);
        $product->update([
            'quantity' => $product->quantity + $validated['quantity'],
            'unit_price' => $validated['unit_price']
        ]);
        return redirect()->route('products.index', [
            'products' => Product::all(),
            'units' => Unit::all()
        ])->with('success', 'Product arrived successfully');
    }

    public function decomission(Product $product)
    {
        return view('products.decomission', [
            'product' => $product,
            'units' => Unit::all(),
        ]);
    }

    public function storeDecomission(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required',
            'unit_id' => 'required',
            'unit_price' => 'required',
            'desc' => 'required'
        ]);
        DecommissionedProduct::create([
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'unit_id' => $validated['unit_id'],
            'unit_price' => $validated['unit_price'],
            'desc' => $validated['desc']
        ]);
        $product->update([
            'quantity' => $product->quantity - $validated['quantity'],
        ]);
        return redirect()->route('products.index', [
            'products' => Product::all(),
            'units' => Unit::all()
        ])->with('success', 'Product decomissioned successfully');
    }

    public function arrivedProducts()
    {
        // я должень к каждый arrivedProductу добавить один поля тип type
        $arrivedProducts = [];
        foreach (ArrivedProduct::all() as $arrivedProduct) {
            $arrivedProduct['type'] = 'Поступление';
            array_push($arrivedProducts, $arrivedProduct);
        }
        $decomissionedProducts = [];
        foreach (DecommissionedProduct::all() as $decomissionedProduct) {
            $decomissionedProduct['type'] = 'Списание';
            array_push($decomissionedProducts, $decomissionedProduct);
        }

        return view('products.analyse', [
            'arrivedProducts' => $arrivedProducts,
            'decomissionedProducts' => $decomissionedProducts,
            'total' => ArrivedProduct::all()->sum('total_price'),
            'total_quantity' => ArrivedProduct::all()->sum('quantity'),
            'total_decomissioned' => DecommissionedProduct::all()->sum('total_price'),
            'total_decomissioned_quantity' => DecommissionedProduct::all()->sum('quantity')
        ]);
    }

    public function filterByData(Request $request)
    {
        $end_date = Carbon::parse($request->end_date)->addDays(1)->toDateString();
        $filteredArrive = ArrivedProduct::whereBetween('created_at', [$request->start_date, $end_date])->get();
        $filteredDecomissioned = DecommissionedProduct::whereBetween('created_at', [$request->start_date, $end_date])->get();
        $arrivedProducts = [];
        foreach ($filteredArrive as $arrivedProduct) {
            $arrivedProduct['type'] = 'Поступление';
            array_push($arrivedProducts, $arrivedProduct);
        }
        $decomissionedProducts = [];
        foreach ($filteredDecomissioned as $decomissionedProduct) {
            $decomissionedProduct['type'] = 'Списание';
            array_push($decomissionedProducts, $decomissionedProduct);
        }
        return view('products.analyse', [
            'arrivedProducts' => $arrivedProducts,
            'decomissionedProducts' => $decomissionedProducts,
            'total' => $filteredArrive->sum('total_price'),
            'total_quantity' => $filteredArrive->sum('quantity'),
            'total_decomissioned' => $filteredDecomissioned->sum('total_price'),
            'total_decomissioned_quantity' => $filteredDecomissioned->sum('quantity'),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
    }
}
