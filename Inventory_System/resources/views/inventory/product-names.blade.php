@extends('layouts.app')

@section('title', 'Product Names')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Product Name List</h2>
    <table class="table table-bordered table-striped" id="productNameTable">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Add Product Name Modal -->
<div class="modal fade" id="addProductNameModal" tabindex="-1" aria-labelledby="addProductNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addProductNameForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Product Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="productNameInput">Product Name</label>
                        <input type="text" class="form-control" name="name" id="productNameInput" placeholder="Enter product name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Product Name Modal -->
<div class="modal fade" id="editProductNameModal" tabindex="-1" aria-labelledby="editProductNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editProductNameForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editProductId">
                    <div class="form-group">
                        <label for="editProductNameInput">Product Name</label>
                        <input type="text" class="form-control" name="name" id="editProductNameInput" placeholder="Edit product name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
    
        fetchProductNames();
    
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
                    Swal.fire('Success!', 'Product name added successfully!', 'success');
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let msg = Object.values(errors).flat().join('<br>');
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: msg,
                        });
                    } else {
                        Swal.fire('Error', xhr.responseJSON.message || 'Failed to add product.', 'error');
                    }
                }
            });
        });
    
        $(document).on('click', '.editBtn', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            $('#editProductId').val(id);
            $('#editProductNameInput').val(name);
            $('#editProductNameModal').modal('show');
        });
    
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
                    Swal.fire('Success!', 'Product name updated successfully!', 'success');
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let msg = Object.values(errors).flat().join('<br>');
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: msg,
                        });
                    } else {
                        Swal.fire('Error', xhr.responseJSON.message || 'Failed to update.', 'error');
                    }
                }
            });
        });
    
        $(document).on('click', '.deleteBtn', function () {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/product-names/${id}`,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function () {
                            fetchProductNames();
                            Swal.fire('Deleted!', 'Product name has been deleted.', 'success');
                        },
                        error: function () {
                            Swal.fire('Error', 'Failed to delete product.', 'error');
                        }
                    });
                }
            });
        });
    });
    </script>
    
@endpush
