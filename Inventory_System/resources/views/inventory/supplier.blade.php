@extends('layouts.app')

@section('title', 'Supplier List')

@section('content')
<x-sidebar.sidebar/>
<div class="container mt-4">
    <h2 class="mb-4">Supplier List</h2>

    <!-- Add Supplier Button -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
        <i class="bi bi-plus-lg"></i> Add Supplier
    </button>

    <!-- Supplier Table -->
    <x-table.table
        id="supplierTable"
        :headers="['Supplier Name', 'Address', 'Email', 'Contact Number', 'Contact Person', 'Website', 'TIN']"
        :rows="[
            ['Supplier A', '123 Main St', 'supplierA@example.com', '123-456-7890', 'John Doe', 'www.supplierA.com', '123456789'],
            ['Supplier B', '456 Elm St', 'supplierB@example.com', '098-765-4321', 'Jane Smith', 'www.supplierB.com', '987654321']
        ]"
    />
</div>

<!-- Add Supplier Modal -->
<x-modal.modal id="addSupplierModal" title="Add Supplier">
    <form>
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <x-forms.form
                    label="Supplier Name"
                    type="text"
                    placeholder="Supplier Name"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-6">
                <x-forms.form
                    label="Address"
                    type="text"
                    placeholder="Address"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-6">
                <x-forms.form
                    label="Email Address"
                    type="email"
                    placeholder="Email"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-6">
                <x-forms.form
                    label="Contact Number"
                    type="text"
                    placeholder="Contact Number"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-6">
                <x-forms.form
                    label="Contact Person"
                    type="text"
                    placeholder="Contact Person"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-6">
                <x-forms.form
                    label="Company Website"
                    type="url"
                    placeholder="https://example.com"
                    col="col-sm-12"
                />
            </div>
            <div class="col-sm-6">
                <x-forms.form
                    label="TIN Number"
                    type="text"
                    placeholder="TIN Number"
                    col="col-sm-12"
                />
            </div>
        </div>
    </form>

    @slot('footer')
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    @endslot
</x-modal.modal>

@endsection
