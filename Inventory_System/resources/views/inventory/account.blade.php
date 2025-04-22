@extends('layouts.app')
@section('content')
<x-sidebar.sidebar/>
<div class="container mt-4">
    <h2 class="mb-4">Account Management</h2>
    <!-- Product Table -->
    <x-table.table
        id="accountTable"
        :headers="['Name', 'Email', 'Role']"
        :rows="[
            ['daryl', 'daryl@gmail.com', 'admin'],
            ['zenji', 'zenji@gmail.com', 'user']
        ]"
    />
</div>
<x-modal.modal id="addProductModal" title="Add Product">
    <x-forms.form
    label="Name"
    type="text"
    placeholder="Full Name"
    />
    <x-forms.form
    label="Email"
    type="email"
    placeholder="Email"
    />
    <x-forms.form
    label="First Name"
    type="text"
    placeholder="First Name"
    />
    <x-forms.form
    label="First Name"
    type="text"
    placeholder="First Name"
    />
</x-modal.modal>
@endsection