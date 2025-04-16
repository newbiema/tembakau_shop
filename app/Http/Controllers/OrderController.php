<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index() 
    {
        $role = Auth::user()->roles[0]->name;

        if ($role === "Admin") {
            $order = Order::with(['product', 'user'])->orderBy('id', 'DESC')->paginate(10);
        } else {
            $order = Order::with(['product', 'user'])->where('users_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        }

        return view("order.index", compact("order"));
    }

    public function show($id) 
    {
        $order = Order::with('product', 'user')->find($id);
        return view("order.show", compact("order"));    
    }

    public function destroy($id) 
    {
        $order = Order::find($id);
        
        if (!$order) {
            return response()->json(['code' => 200, 'status' => 'error', 'message' => 'Data tidak ditemukan.']);
        }

        $order->delete();

        return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Berhasil menghapus data transaksi.']);
    }
}
