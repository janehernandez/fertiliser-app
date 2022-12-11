<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name')->paginate(10);
        return Inertia::render('Products', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $productCode = 'FRT-' . now()->timestamp;
        $productCount = Product::count() + 1;

        Product::create([
            'name' => "FERTILISER-${productCount}",
            'code' => $productCode,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
        ]);

        return back()->with('message', 'Product is successfully created');
    }
}
