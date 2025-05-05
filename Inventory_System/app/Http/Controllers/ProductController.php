<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->fetchAll();
    }
    public function fetchAll() {
		$product = Product::all();
        return view ('inventory/product', ['products'=>$product]);
	}
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_type' => 'required|string',
            'product_number' => 'required|string',
            'serial_number' => 'required|string',
            'brand' => 'required|string',
            'date_acquired' => 'required|date',
            'price' => 'required|string',
            'office_location' => 'required|string',
            'issued_to' => 'required|string',
            'end_user' => 'required|string',
        ]);

        Product::create($validated);

        return redirect()->back()->with('success', 'Product added successfully!');
    }



    public function edit(Request $request) {
		$id = $request->id;
		$emp = Product::find($id);
		return response()->json($emp);
	}
	// handle update an employee ajax request
	public function update(Request $request) {
		$fileName = '';
		$emp = Product::find($request->emp_id);
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($emp->avatar) {
				Storage::delete('public/images/' . $emp->avatar);
			}
		} else {
			$fileName = $request->emp_avatar;
		}
		$empData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'email' => $request->email, 'phone' => $request->phone, 'post' => $request->post, 'avatar' => $fileName];
		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}
	// handle delete an employee ajax request
	public function delete(Request $request) {
		$id = $request->id;
		$emp = Product::find($id);

		if ($emp) {
			if ($emp->avatar && Storage::exists('public/images/' . $emp->avatar)) {
				Storage::delete('public/images/' . $emp->avatar);
			}
			$emp->delete();
			return response()->json(['status' => 200, 'message' => 'Employee deleted successfully']);
		} else {
			return response()->json(['status' => 404, 'message' => 'Employee not found']);
		}
	}
}
