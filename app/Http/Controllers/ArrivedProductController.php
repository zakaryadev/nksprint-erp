<?php

namespace App\Http\Controllers;

use App\Models\ArrivedProduct;
use Illuminate\Http\Request;

class ArrivedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ArrivedProduct $arrivedProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ArrivedProduct $arrivedProduct)
    {
        dd($arrivedProduct);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArrivedProduct $arrivedProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArrivedProduct $arrivedProduct)
    {
        //
    }
}
