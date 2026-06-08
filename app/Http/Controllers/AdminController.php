<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders = Order::with('items.menu')->latest()->get();
        $menus = Menu::all();
        
        return view('admin.dashboard', compact('orders', 'menus'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function toggleMenuStatus($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->update(['is_available' => !$menu->is_available]);
        return back()->with('success', 'Status menu berhasil diperbarui!');
    }
}
