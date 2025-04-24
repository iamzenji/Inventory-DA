@extends('layouts.app')

@section('title', 'Product Names')

@section('content')
<x-sidebar.sidebar/>

<div class="container mt-4">
    <h2 class="mb-4">Product Name List</h2>

    <!-- Add Product Name Button -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addProductNameModal">
        <i class="bi bi-plus-lg"></i> Add Product Name
    </button>

    <!-- Product Name Table -->
    <x-table.table
        id="productNameTable"
        :headers="['Product Name']"
        :rows="[
            ['Laptop', ],
            ['Smartphone']
        ]"
    />
</div>

<!-- Add Product Name Modal -->
<x-modal.modal id="addProductNameModal" title="Add Product Name">
    <form>
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <x-forms.form
                    label="Product Name"
                    type="text"
                    placeholder="Enter product name"
                    col="col-sm-12"
                />
            </div>
        </div>

        @slot('footer')
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        @endslot
    </form>
</x-modal.modal>

<!-- Edit Product Name Modal (example only - update with dynamic data) -->
<x-modal.modal id="editProductNameModal" title="Edit Product Name">
    <form>
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <x-forms.form
                    label="Product Name"
                    type="text"
                    value="Laptop"
                    placeholder="Edit product name"
                    col="col-sm-12"
                />
            </div>
        </div>

        @slot('footer')
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update</button>
        @endslot
    </form>
</x-modal.modal>

@endsection
