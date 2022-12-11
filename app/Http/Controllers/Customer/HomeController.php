<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $products = Product::where('quantity', '>', 0)->orderBy('name')->paginate(10);
        return Inertia::render('Customer/Home', compact('products'));
    }
}
