<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLogOrderTransactionRequest;
use App\Models\LogOrderTransaction;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function __invoke(StoreLogOrderTransactionRequest $request)
    {
        $userId = Auth::user()->id;

        DB::transaction(function () use ($request, $userId) {
            // Create first Order Purchase
            $orderNo = 'PRC-' . $userId . '-' . now()->timestamp;

            $order = Order::create([
                'order_no' => $orderNo,
                'user_id' => $userId,
                'total_quantity' => array_sum(array_column($request->list, 'purchased_quantity')),
                'total_amount' => array_sum(array_column($request->list, 'total_price')),
            ]);

            foreach ($request->list as $key => $item) {
                // Insert all the items or products purchased by the customer
                LogOrderTransaction::create([
                    'product_id' => $key,
                    'user_id' => $userId,
                    'order_id' => $order->id,
                    'quantity' => $item['purchased_quantity'],
                    'availed_price' => $item['availed_price'],
                    'total_price' => $item['total_price'],
                ]);

                // Update Product Inventory
                $product = Product::find($key);
                $product->update([
                    'quantity' => $product->quantity - $item['purchased_quantity']
                ]);
            }
        });

        return back()->with('message', 'Order is successfully purchased');
    }
}
