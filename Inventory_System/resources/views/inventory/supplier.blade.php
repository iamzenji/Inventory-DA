@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <h2 class="fw-bold text-success"> Register Supplier</h2>
        </div>
        <div class="col-md-6 text-md-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-success">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registered Supplier</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="table-responsive" style="border: 1px solid #ddd; border-radius: 10px; padding: 10px;">
        <table id="supplier-table" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Supplier Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Contact Person</th>
                    <th>Website</th>
                    <th>TIN</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

{{-- ADD SUPPLIER MODAL --}}
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createSupplierForm">
                    @csrf
                    <div class="mb-3">
                        <label for="supplier_name" class="form-label">Supplier Name</label>
                        <input type="text" class="form-control" id="supplier_name" name="supplier_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="supplier_address" name="supplier_address" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="supplier_email" name="supplier_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_number" class="form-label">Contact Number</label>
                        <input type="number" class="form-control" id="supplier_number" name="supplier_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_person" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="contact_person" name="contact_person" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_website" class="form-label">Website</label>
                        <input type="text" class="form-control" id="supplier_website" name="website" required>
                    </div>
                    <div class="mb-3">
                        <label for="tin" class="form-label">Tin</label>
                        <input type="text" class="form-control" id="tin" name="tin" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Supplier</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- EDIT SUPPLIER MODAL --}}
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSupplierForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="edit-supplier-id">
                    <div class="mb-3">
                        <label class="form-label">Supplier Name</label>
                        <input type="text" class="form-control" id="edit-supplier-name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supplier Address</label>
                        <input type="text" class="form-control" id="edit-supplier-address" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supplier Email</label>
                        <input type="email" class="form-control" id="edit-supplier-email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="number" class="form-control" id="edit-contact-number" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="edit-contact-person" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Website</label>
                        <input type="text" class="form-control" id="edit-website" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tin</label>
                        <input type="text" class="form-control" id="edit-tin" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    let table = $('#supplier-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/supplier/data",
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                text: '<i class="bi bi-plus-lg"></i> Add',
                className: 'btn btn-success',
                action: function () {
                    $('#addSupplierModal').modal('show');
                }
            },
            { extend: 'copy', text: '<i class="bi bi-clipboard"></i> Copy', className: 'btn btn-success' },
            { extend: 'excel', text: '<i class="bi bi-file-earmark-excel"></i> Excel', className: 'btn btn-success' },
            { extend: 'csv', text: '<i class="bi bi-file-earmark-text"></i> CSV', className: 'btn btn-success' },
            { extend: 'pdf', text: '<i class="bi bi-file-earmark-pdf"></i> PDF', className: 'btn btn-success' },
            { extend: 'print', text: '<i class="bi bi-printer"></i> Print', className: 'btn btn-success' }
        ],
        columns: [
            { data: null, name: 'id', render: (data, type, row, meta) => meta.row + 1 },
            { data: 'supplier_name' },
            { data: 'supplier_address' },
            { data: 'supplier_email' },
            { data: 'supplier_number' },
            { data: 'contact_person' },
            { data: 'supplier_website' },
            { data: 'tin' },
            {
                data: 'actions', // Use the actions column for edit/delete buttons
                orderable: false,
                searchable: false
            }
        ]
    });

    // Store new supplier
    $('#createSupplierForm').on('submit', function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.post("{{ route('supplier.store') }}", formData, function(response) {
            Swal.fire('Success!', response.success, 'success');
            $('#addSupplierModal').modal('hide');
            $('#createSupplierForm')[0].reset();
            table.ajax.reload();
        }).fail(function(xhr) {
            let errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
            Swal.fire('Error!', errorMessage, 'error');
        });
    });

    // Edit supplier
    $(document).on('click', '.edit-supplier', function () {
        const data = $(this).data();
        $('#edit-supplier-id').val(data.id);
        $('#edit-supplier-name').val(data.supplier_name);
        $('#edit-supplier-address').val(data.supplier_address);
        $('#edit-supplier-email').val(data.supplier_email);
        $('#edit-contact-number').val(data.supplier_number);
        $('#edit-contact-person').val(data.contact_person);
        $('#edit-website').val(data.supplier_website);
        $('#edit-tin').val(data.tin);
    });

    // Update supplier
    $('#editSupplierForm').submit(function (e) {
        e.preventDefault();
        let id = $('#edit-supplier-id').val();
        let formData = $(this).serialize();

        $.ajax({
            url: `/supplier/${id}`,
            type: 'PUT',
            data: formData,
            success: function (response) {
                Swal.fire('Updated!', response.success, 'success');
                $('#editSupplierModal').modal('hide');
                table.ajax.reload();
            },
            error: function (xhr) {
                let errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
                Swal.fire('Error!', errorMessage, 'error');
            }
        });
    });

    // Delete supplier
    $(document).on('click', '.delete-supplier', function () {
        const supplierId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/supplier/${supplierId}`,
                    type: 'DELETE',
                    success: function (response) {
                        Swal.fire('Deleted!', response.success, 'success');
                        table.ajax.reload();
                    },
                    error: function (xhr) {
                        let errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
                        Swal.fire('Error!', errorMessage, 'error');
                    }
                });
            }
        });
    });
});

</script>
@endpush
