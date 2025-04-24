<?php

namespace App\Http\Controllers;

use App\Models\ProductName;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductName::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_names,name',
        ]);

        $productName = ProductName::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Product Name added successfully!',
            'product' => $productName,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_names,name,' . $id,
        ]);

        $productName = ProductName::findOrFail($id);
        $productName->update(['name' => $request->name]);

        return response()->json([
            'message' => 'Product Name updated successfully!',
            'product' => $productName,
        ]);
    }

    public function destroy($id)
    {
        $productName = ProductName::findOrFail($id);
        $productName->delete();

        return response()->json([
            'message' => 'Product Name deleted successfully!',
        ]);
    }
}
