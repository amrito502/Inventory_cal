<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
       
        // Create the product
        $product = Product::create([
            'sku' => $request->sku,
            'product_name' => $request->product_name,
            'cost_price' => $request->cost_price,
            'additional_cost' => $request->additional_cost,
        ]);

        // Return a success response
        return redirect()->back()->with('success','Product Created');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
