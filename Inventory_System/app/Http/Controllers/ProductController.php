<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display all products
    public function index()
    {
        return view('inventory.product');
    }

    // Get product data for DataTables (AJAX)
    public function getData(Request $request)
    {
        $products = Product::query();

        return datatables()->of($products)
            ->addColumn('action', function ($product) {
                return view('inventory.product-actions', compact('product'))->render();
            })
            ->make(true);
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'product_type' => 'required',
            'product_number' => 'required',
            'serial_number' => 'required',
            'brand' => 'required',
            'date_acquired' => 'required|date',
            'price' => 'required|numeric',
            'office_location' => 'required',
            'issued_to' => 'required',
            'end_user' => 'required',
        ]);

        Product::create($request->all());  // Create a new product using the data from the form

        return response()->json(['success' => 'Product added successfully!']);
    }

    // Edit and update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return response()->json(['success' => 'Product updated successfully!']);
    }
}
