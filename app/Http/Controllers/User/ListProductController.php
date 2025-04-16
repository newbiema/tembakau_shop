<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListProductController extends Controller
{
    public function index(Request $request) 
    {
        $search = $request->search;

        $product = Product::query();

        if (!empty($search)) {
            $product->where('name', 'like', '%' . $search . '%')
                    ->orWhere('stock', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%'. $search . '%');
        }

        $products = $product->orderBy('id', 'DESC')->paginate(8);

        return view("user.list", compact("products"));    
    }

    public function show($id) 
    {
        $product = Product::find($id);
        $products = Product::orderBy('id', 'ASC')->take(4)->get();
        return view("user.show-product", compact("product", "products"));    
    }

    public function store(Request $request) 
    {
        $request->validate([
            "qty" => "required"
        ]);  

        $post = $request->all();

        $product = Product::where('id', $request->products_id)->first();

        $post['users_id'] = Auth::user()->id;
        $post['products_id'] = $request->products_id;
        $post['qty'] = $request->qty;
        $post['total'] = $request->qty * $product->harga;
        $post['status'] = 'payment';

        $product->update(['stock' => $product->stock - $request->qty]);

        $order = Order::create($post);

        return redirect()->route('user.product.payment', ['order_id' => $order->id]);
    }

    public function payment($order_id) 
    {
        $order = Order::with('product', 'user')->where('id', $order_id)->first();
        return view("user.payment", compact("order"));
    }

    public function update($id) 
    {
        $order = Order::find($id);
        
        $order->update(['status' => 'pending']);

        return redirect()->route('user.product')->with('success', 'Berhasil melakukan pembelian');
    }
}
