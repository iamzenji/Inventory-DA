@extends('layouts.app')

@section('title', 'Product List')

@section('content')
<x-header.header/>
<div class="container mt-4">
    <h2 class="mb-4">Product List</h2>

    <!-- Add Product Button -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
        <i class="bi bi-plus-lg"></i> Add Product
    </button>

    <!-- Product Table -->
    <x-table.table 
        id="productTable"
        :headers="['Product Type', 'Product Number', 'Serial Number', 'Brand', 'Date Acquired', 'Price', 'Office Location', 'Issued To', 'End User']"
        :rows="[
            ['Laptop', '12345', 'ABC123', 'Brand A', '2024-01-01', '$500', 'Office A', 'Employee 1', 'User A'],
            ['Phone', '67890', 'XYZ678', 'Brand B', '2024-03-01', '$300', 'Office B', 'Employee 2', 'User B']
        ]"
    />
</div>

<!-- Add Product Modal -->
<x-modal.modal id="addProductModal" title="Add Product">
    <form>
        @csrf
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="product_name">
        </div>
        <div class="mb-3">
            <label class="form-label">Serial Number</label>
            <input type="text" class="form-control" name="serial_number">
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text" class="form-control" name="price">
        </div>
        <!-- Add more fields here -->

    </form>

    @slot('footer')
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    @endslot
</x-modal.modal>

@endsection
