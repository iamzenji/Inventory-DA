<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Product;
use App\Models\ProductName;   // <-- Import ProductName model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('inventory.product');
    }

    public function getData(Request $request)
    {
        $products = Product::query()->get();

        return DataTables::of($products)
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

        Product::create($request->all());

        return response()->json(['success' => 'Product added successfully!']);
    }

    // Edit and update product
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return response()->json(['success' => 'Product updated successfully!']);
    }

    // Delete product
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['success' => 'Product deleted successfully']);
    }

    // --------------- ProductName Methods --------------- //

    // Show ProductName list view (optional if you want separate page)
    public function productNamesIndex()
    {
        // Return a view if you have one for product names
        return view('inventory.product-names');
    }

    // Get ProductName data for DataTables
    public function getProductNames()
    {
        $productNames = ProductName::all();

        return response()->json($productNames);
    }

    // Store a new ProductName
    public function storeProductName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:product_names,name',
        ]);

        ProductName::create($request->only('name'));

        return response()->json(['success' => 'Product name added successfully!']);
    }

    // Update a ProductName
    public function updateProductName(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:product_names,name,' . $id,
        ]);

        $productName = ProductName::findOrFail($id);
        $productName->update($request->only('name'));

        return response()->json(['success' => 'Product name updated successfully!']);
    }

    // Delete a ProductName
    public function deleteProductName($id)
    {
        $productName = ProductName::findOrFail($id);
        $productName->delete();

        return response()->json(['success' => 'Product name deleted successfully']);
    }
}
