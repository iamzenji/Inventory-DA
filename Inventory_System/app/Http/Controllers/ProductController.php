<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductName;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('inventory/product');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_type' => 'required|string',
            'product_number' => 'required|string',
            'serial_number' => 'required|string',
            'brand' => 'required|string',
            'date_acquired' => 'required|date',
            'price' => 'required|numeric',
            'office_location' => 'required|string',
            'issued_to' => 'required|string',
            'end_user' => 'required|string',
        ]);

        // Create the product
        $product = Product::create($validated);

        if ($product) {
            return response()->json(['status' => 200, 'message' => 'Product added successfully']);
        }

        return response()->json(['status' => 500, 'message' => 'Failed to add product']);
    }

    // Fetch Products (For DataTable)
    public function fetchAll()
    {
        $products = Product::all();
        return response()->json(['data' => $products]);
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
