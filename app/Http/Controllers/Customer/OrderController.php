<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\LogOrderTransaction;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $orders = Order::whereUserId($userId)->paginate(10);
        $logOrders = LogOrderTransaction::with('product')->whereUserId($userId)->get();
        return Inertia::render('Customer/Orders/Index', compact('orders', 'logOrders'));
    }
}
