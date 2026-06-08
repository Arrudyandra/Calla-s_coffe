<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'payment_method' => 'required|string',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        try {
            DB::beginTransaction();

            $totalPrice = 0;
            $orderCode = 'ORD-' . strtoupper(Str::random(6));
            $receiptNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(4));

            $order = Order::create([
                'receipt_number' => $receiptNumber,
                'order_code' => $orderCode,
                'customer_name' => $request->customer_name,
                'payment_method' => $request->payment_method,
                'total_price' => 0, // temporary
                'status' => 'pending'
            ]);

            foreach ($request->items as $item) {
                $menu = Menu::find($item['menu_id']);
                $subtotal = $menu->price * $item['quantity'];
                $totalPrice += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $item['quantity'],
                    'price' => $menu->price
                ]);
            }

            $order->update(['total_price' => $totalPrice]);

            DB::commit();

            return response()->json([
                'message' => 'Pesanan berhasil dibuat!',
                'order_code' => $orderCode,
                'receipt_number' => $receiptNumber
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function getMenus()
    {
        return response()->json(Menu::where('is_available', true)->get());
    }

    public function track($code)
    {
        $order = Order::with('items.menu')->where('receipt_number', $code)->first();
        if (!$order) {
            return response()->json(['message' => 'Nota pesanan tidak ditemukan.'], 404);
        }
        return response()->json($order);
    }
}
