<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        return view("admin.product.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'umur' => 'required',
            'jumlah' => 'required',
            'stock' => 'required',
            'harga' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg'
        ]);

        $post = $request->except('image');

        $image = $request->file('image');
        $imageName = rand() . '.' . $image->getClientOriginalExtension();
        $path = 'product/';
        $image->move($path, $imageName);

        $post['image'] = $path . $imageName;

        Product::create($post);

        return redirect()->route('admin.product')->with('success', 'Berhasil menambahkan data product baru.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view("admin.product.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'umur' => 'required',
            'jumlah' => 'required',
            'stock' => 'required',
            'harga' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpeg,jpg'
        ]);

        $product = Product::find($id);

        $put = $request->except('image');

        if ($request->hasFile('image')) {
            unlink($product->image);

            $image = $request->file('image');
            $imageName = rand() . '.' . $image->getClientOriginalExtension();
            $path = 'product/';
            $image->move($path, $imageName);

            $put['image'] = $path . $imageName;

            $product->update($put);
        } else {
            $product->update($put);
        }

        return redirect()->route('admin.product')->with('success', 'Berhasil mengubah data product.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['code' => 400, 'status' => 'error', 'message' => 'Data Not Found']);
        }

        unlink(public_path($product->image));

        $product->delete();

        return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Berhasil menghapus data product.']);
    }
}
