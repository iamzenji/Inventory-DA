@extends('layouts.app')

@section('title', 'Brand List')

@section('content')
<x-sidebar.sidebar/>

<div class="container mt-4">
    <h2 class="mb-4">Brand List</h2>

    <!-- Add Brand Button -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addBrandModal">
        <i class="bi bi-plus-lg"></i> Add Brand
    </button>

    <!-- Brand Table -->
    <x-table.table
        id="brandTable"
        :headers="['Brand Name']"
        :rows="[
            ['Brand A'],
            ['Brand B']
        ]"
    />
</div>

<!-- Add Brand Modal -->
<x-modal.modal id="addBrandModal" title="Add Brand">
    <form>
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <x-forms.form
                    label="Brand Name"
                    type="text"
                    placeholder="Enter brand name"
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

<!-- Edit Brand Modal (example only - you might want dynamic data here) -->
<x-modal.modal id="editBrandModal" title="Edit Brand">
    <form>
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <x-forms.form
                    label="Brand Name"
                    type="text"
                    placeholder="Edit brand name"
                    col="col-sm-12"
                    value="Brand A"
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
