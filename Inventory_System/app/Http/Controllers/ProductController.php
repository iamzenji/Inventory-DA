<?php

namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
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

        Product::create($request->all());  // Create a new product using the data from the form

        return response()->json(['success' => 'Product added successfully!']);
    }

    // Edit and update product
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return response()->json(['success' => 'Product updated successfully!']);
    }
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['success' => 'User deleted successfully']);
    }

}
