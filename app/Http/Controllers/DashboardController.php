<?php

namespace App\Http\Controllers;

use App\Models\LogOrderTransaction;
use App\Models\Order;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $logOrders  = LogOrderTransaction::with('product', 'order')->orderByDesc('created_at')->paginate(10);
        $orders     = Order::all();
        $summary    = [
            'total_orders'      => $orders->count(),
            'total_quantities'  => array_sum(array_column($orders->toArray(), 'total_quantity')),
            'total_sold'        => array_sum(array_column($orders->toArray(), 'total_amount')),
        ];

        return Inertia::render('Dashboard', compact('summary', 'logOrders'));
    }
}
