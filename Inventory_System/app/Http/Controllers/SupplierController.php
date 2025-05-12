<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        return view('inventory.supplier');
    }

    public function getData(Request $request)
{
    $suppliers = Supplier::query();

    return DataTables::of($suppliers)
        ->addColumn('actions', function ($supplier) {
            return '
                <button class="btn btn-warning btn-sm edit-supplier" data-id="' . $supplier->id . '" data-supplier_name="' . $supplier->supplier_name . '" data-supplier_address="' . $supplier->supplier_address . '" data-supplier_email="' . $supplier->supplier_email . '" data-supplier_number="' . $supplier->supplier_number . '" data-contact_person="' . $supplier->contact_person . '" data-supplier_website="' . $supplier->supplier_website . '" data-tin="' . $supplier->tin . '" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                    <i class="fas fa-pencil-alt"></i> Edit</button>
                <button class="btn btn-danger btn-sm delete-supplier" data-id="' . $supplier->id . '">
                    <i class="bi bi-trash"></i> Delete</button>
            ';
        })
        ->rawColumns(['actions']) // Ensure the 'actions' column is treated as raw HTML
        ->make(true);
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_name' => 'required',
            'supplier_address' => 'required',
            'supplier_email' => 'required|email',
            'supplier_number' => 'required',
            'contact_person' => 'required',
            'supplier_website' => 'nullable|string',
            'tin' => 'nullable|string|max:15',
        ]);

        Supplier::create($validated);

        return response()->json(['success' => 'Supplier added successfully!']);
    }

    public function updateSupplier(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->update($request->all());

        return response()->json(['success' => 'Supplier updated successfully!']);
    }

    public function deleteSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return response()->json(['success' => 'Supplier deleted successfully!']);
    }
}
