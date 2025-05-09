<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class SupplierController extends Controller
{
    public function index()
    {
        return view('inventory.supplier');
    }
    public function getData(Request $request)
    {
        $suppliers = Supplier::query()->get();

        return DataTables::of($suppliers)
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required',
            'supplier_address' => 'required',
            'supplier_email' => 'required|email',
            'supplier_number' => 'required',
            'contact_person' => 'required',
            'supplier_website' => 'nullable',
            'tin' => 'nullable|string|max:15',
        ]);

        Supplier::create($request->all());

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

        return response()->json(['success' => 'Supplier deleted successfully']);
    }
}
