<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return response()->json(Department::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments,name'
        ]);

        Department::create($request->only('name'));
        return response()->json(['message' => 'Department added successfully']);
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|unique:departments,name,' . $department->id
        ]);

        $department->update($request->only('name'));
        return response()->json(['message' => 'Department updated successfully']);
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json(['message' => 'Department deleted successfully']);
    }
}
