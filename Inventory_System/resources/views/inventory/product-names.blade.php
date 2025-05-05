@extends('layouts.app')

@section('title', 'Product Names')

@section('content')
<x-sidebar.sidebar/>

<div class="container mt-4">
    <h2 class="mb-4">Product Name List</h2>

    <x-table.table
        id="productNameTable"
        :headers="['Product Name', 'Actions']"
        :rows="[]"
        modal-id="addProductNameModal"
    />
</div>

<!-- Add Product Name Modal -->
<x-modal.modal
    id="addProductNameModal"
    title="Add Product Name"
    saveButtonText="Save"
    saveAction=""
>
    <form id="addProductNameForm">
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="productNameInput">Product Name</label>
                    <input type="text" class="form-control" name="name" id="productNameInput" placeholder="Enter product name" required>
                </div>
            </div>
        </div>
    </form>
</x-modal.modal>

<!-- Edit Product Name Modal -->
<x-modal.modal
    id="editProductNameModal"
    title="Edit Product Name"
    saveButtonText="Update"
    saveAction=""
>
    <form id="editProductNameForm">
        @csrf
        @method('PUT')
        <input type="hidden" id="editProductId">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="editProductNameInput">Product Name</label>
                    <input type="text" class="form-control" name="name" id="editProductNameInput" placeholder="Edit product name" required>
                </div>
            </div>
        </div>
    </form>
</x-modal.modal>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    let dataTable;

    function fetchProductNames() {
        $.get("{{ route('product-names.index') }}", function (data) {
            const table = $('#productNameTable');

            // Check if DataTable is initialized and destroy if already initialized
            if ($.fn.DataTable.isDataTable(table)) {
                table.DataTable().clear().destroy();
            }

            let rows = '';
            data.forEach(product => {
                rows += `
                    <tr>
                        <td>${product.name}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-warning editBtn" data-id="${product.id}" data-name="${product.name}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtn" data-id="${product.id}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });

            table.find('tbody').html(rows);

            // Initialize DataTable
            dataTable = table.DataTable({
                dom: "<'row'<'col-md-8'B><'col-md-4'f>>" +
                    "<'row'<'col-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                aLengthMenu: [[10, 25, 50, -1], ['10 rows', '25 rows', '50 rows', 'All']],
                buttons: [
                    {
                        text: '<i class="bi bi-plus-lg"></i> Add',
                        className: 'btn btn-success',
                        action: function () {
                            $('#addProductNameForm')[0].reset();
                            $('#addProductNameModal').modal('show');
                        }
                    },
                    'copy', 'excel', 'csv', 'pdf', 'print', 'colvis'
                ]
            });
        });
    }

    // Fetch product names when the page loads
    fetchProductNames();

    // Add product name form submit
    $('#addProductNameForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('product-names.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $('#addProductNameModal').modal('hide');
                fetchProductNames();
                $('#addProductNameForm')[0].reset();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let msg = Object.values(errors).flat().join('\n');
                    alert("Validation Error:\n" + msg);
                } else {
                    alert(xhr.responseJSON.message || 'Failed to add product.');
                }
            }
        });
    });

    // Edit product button click
    $(document).on('click', '.editBtn', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        $('#editProductId').val(id);
        $('#editProductNameInput').val(name);
        $('#editProductNameModal').modal('show');
    });

    // Edit product name form submit
    $('#editProductNameForm').submit(function (e) {
        e.preventDefault();
        const id = $('#editProductId').val();
        $.ajax({
            url: `/product-names/${id}`,
            method: 'POST',
            data: {
                _method: 'PUT',
                _token: '{{ csrf_token() }}',
                name: $('#editProductNameInput').val()
            },
            success: function () {
                $('#editProductNameModal').modal('hide');
                fetchProductNames();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let msg = Object.values(errors).flat().join('\n');
                    alert("Validation Error:\n" + msg);
                } else {
                    alert(xhr.responseJSON.message || 'Failed to update.');
                }
            }
        });
    });































    

    // Delete product button click
    $(document).on('click', '.deleteBtn', function () {
        if (confirm('Are you sure?')) {
            const id = $(this).data('id');
            $.ajax({
                url: `/product-names/${id}`,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function () {
                    fetchProductNames();
                },
                error: function () {
                    alert('Failed to delete product.');
                }
            });
        }
    });
});
</script>
@endpush
