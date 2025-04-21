@extends('layouts.app')

@section('title', 'Product List')

@section('content')
<x-sidebar.sidebar/>
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
        <div class="row">
            <div class="col-sm-6">
                <x-forms.form
                    label="Product Name"
                    type="number"
                    placeholder="Product Name"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-6">
                <x-forms.form
                    label="Product Number"
                    type="number"
                    placeholder="Product Number"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-6">
                <x-forms.form
                    label="Serial Number"
                    type="text"
                    placeholder="Serial Name"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-6">
                <x-forms.form
                    label="Brand"
                    type="text"
                    placeholder="Brand"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-6">
                <x-forms.form
                    label="Date Acquired"
                    type="date"
                    placeholder="Date Acquired"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-6">
                <x-forms.form
                    label="Price"
                    type="text"
                    placeholder="Price"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-4">
                <x-forms.form
                    label="Office Location"
                    type="text"
                    placeholder="Office Location"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-4">
                <x-forms.form
                    label="Issue To"
                    type="text"
                    placeholder="Issue To"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-4">
                <x-forms.form
                    label="End User"
                    type="text"
                    placeholder="End User"
                    col="col-sm-12"
                />
            </div>
        </div>
        <!-- Add more fields here -->

    </form>

    @slot('footer')
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    @endslot
</x-modal.modal>

@endsection
