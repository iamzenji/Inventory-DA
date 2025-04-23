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

        datas={{ $users }}
    />
</div>
    {{-- {{ $users }} --}}
<table>
    <thead>
        <tr>
            <th>name</th>
            <th>email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td> {{ $user->name }}</td>
            <td>{{ $user->email }}</td>
        </tr>
        @endforeach
    </tbody>

</table>
<x-modal.modal id="addProductModal" title="Add Account">
    <form method="POST">
        @csrf
        <x-forms.form name="name" label="Name" type="text" placeholder="Full Name" />
        <x-forms.form name="email" label="Email" type="email" placeholder="Email" />
        
        <select name="role" id="" class="form-control" >
            <option value="">Select role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}"> {{ $role->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary mt-2">Create</button>
    </form>


</x-modal.modal>
@endsection