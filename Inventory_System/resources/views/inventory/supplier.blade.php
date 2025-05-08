@extends('layouts.app')
@section('content')

<div class="container">
    {{-- Breadcrumb Navigation --}}
    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <h2 class="fw-bold text-success"> Register Supplies</h2>
        </div>
        <div class="col-md-6 text-md-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-success">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registered Products</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="table-responsive" style="border: 1px solid #ddd; border-radius: 10px; padding: 10px; border-collapse: separate; border-spacing: 0;">
        <table id="Supplier-table" class="table table-striped">
            <thead>
                <tr>
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
                <h5 class="modal-title" id="addSupplierModalLabel">Register Supplier</h5>
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
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="number" class="form-control" id="contact_number" name="contact_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_person" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="contact_person" name="contact_person" required>
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" class="form-control" id="website" name="website" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_tin" class="form-label">Tin</label>
                        <input type="text" class="form-control" id="tin" name="tin" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Supplier</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- EDIT SUPPLIER MODAL -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editSupplierForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="edit-supplier-id">

                    <div class="mb-3">
                        <label for="edit-supplier-name" class="form-label">Supplier Name</label>
                        <input type="text" class="form-control" id="edit-supplier-name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-supplier-address" class="form-label">Supplier Address</label>
                        <input type="text" class="form-control" id="edit-supplier-address" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-supplier-email" class="form-label">Supplier Email</label>
                        <input type="email" class="form-control" id="edit-supplier-email" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-supplier-number" class="form-label">Brand</label>
                        <input type="number" class="form-control" id="edit-supplier-number" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-contact-person" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="edit-contact-person" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-website" class="form-label">Website</label>
                        <input type="text" class="form-control" id="edit-website" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-tin" class="form-label">Tin</label>
                        <input type="text" class="form-control" id="edit-tin" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        let table = $('#Supplier-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/supplier/data",
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    text: '<i class="bi bi-plus-lg"></i> Add',
                    className: 'btn btn-success',
                    action: function (e, dt, node, config) {
                        $('#addSupplierModal').modal('show');
                    }
                },
                {
                    extend: 'copy',
                    text: '<i class="bi bi-clipboard"></i> Copy',
                    className: 'btn btn-success'
                },
                {
                    extend: 'excel',
                    text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                    className: 'btn btn-success'
                },
                {
                    extend: 'csv',
                    text: '<i class="bi bi-file-earmark-text"></i> CSV',
                    className: 'btn btn-success'
                },
                {
                    extend: 'pdf',
                    text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                    className: 'btn btn-success'
                },
                {
                    extend: 'print',
                    text: '<i class="bi bi-printer"></i> Print',
                    className: 'btn btn-success'
                }
            ],
            columns: [
                {
                    data: null,
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + 1;  // meta.row gives you the index of the row, starting from 0
                    }
                },
                { data: 'supplier_name', name: 'supplier_name' },
                { data: 'supplier_address', name: 'supplier_address' },
                { data: 'supplier_email', name: 'supplier_email' },
                { data: 'contact_number', name: 'contact_number' },
                { data: 'contact_person', name: 'contact_person' },
                { data: 'website', name: 'website' },
                { data: 'tin', name: 'tin' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                            <button class="btn btn-warning btn-sm edit-supplier"
                                    data-id="${row.id}"
                                    data-supplier_name="${row.supplier_name}"
                                    data-supplier_address="${row.supplier_address}"
                                    data-supplier_email="${row.supplier_email}"
                                    data-contact_number="${row.contact_number}"
                                    data-contact_person="${row.contact_person}"
                                    data-website="${row.website}"
                                    data-tin="${row.tin}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editSupplierModal">
                                    <i class="fas fa-pencil-alt"></i>
                            </button>

                            <button class="btn btn-danger btn-sm delete-user"
                                    data-id="${row.id}">
                                <i class="bi bi-trash"></i>
                            </button>
                        `;
                    }
                }
            ]
        });
        // Create Product Form Submission
        $('#createSupplierForm').on('submit', function (e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: "{{ route('supplier.store') }}",
                data: formData,
                success: function (response) {
                    Swal.fire('Success!', response.success, 'success');
                    $('#addSupplierModal').modal('hide');
                    $('#createSupplierForm')[0].reset();
                    $('#Supplier-table').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = Object.values(errors).join('<br>');
                    Swal.fire('Error!', errorMessage, 'error');
                }
            });
        });

        // Open Edit Product Modal
        $(document).on('click', '.edit-supplies', function() {
            let supplierId = $(this).data('id');
            let supplierName = $(this).data('supplier_name');
            let supplierAddress = $(this).data('supplier_address');
            let supplierEmail = $(this).data('supplier_email');
            let contactNumber = $(this).data('contact_number');
            let contactPerson = $(this).data('contact_person');
            let website = $(this).data('website');
            let tin = $(this).data('tin');

            $('#edit-supplier-id').val(supplierId);
            $('#edit-supplier-name').val(supplierName);
            $('#edit-supplier-address').val(supplierAddress);
            $('#edit-supplier-email').val(supplierEmail);
            $('#edit-contact-number').val(contactNumber);
            $('#edit-contact-person').val(contactPerson);
            $('#edit-website').val(website);
            $('#edit-tin').val(tin);
        });

        // Handle Update Form Submission
        $('#editSupplierForm').submit(function(event) {
            event.preventDefault();

            let supplierId = $('#edit-supplier-id').val();
            let supplierName = $('#edit-supplier-name').val();
            let supplierAddress = $('#edit-supplier-address').val();
            let supplierEmail = $('#edit-supplier-email').val();
            let contactNumber = $('#edit-supplier-number').val();
            let contactPerson = $('#edit-supplier-person').val();
            let website = $('#edit-supplier-website').val();
            let tin = $('#edit-supplier-tin').val();

            $.ajax({
                url: '{{ url("supplier/update") }}/' + productId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    supplier_name: supplierName,
                    supplier_address: supplierAddress,
                    supplier_email: supplierEmail,
                    supplier_number: contactNumber,
                    supplier_contact: contactPerson,
                    website: website,
                    tin: tin,
                },
                success: function(response) {
                    Swal.fire('Success!', response.success, 'success');
                    $('#editSupplierModal').modal('hide');
                    $('#Supplier-table').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON.message, 'error');
                }
            });
        });

        // Handle Delete Button Click
        $(document).on('click', '.delete-user', function() {
            let userId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("supplier/delete") }}/' + userId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.success
                            });
                            table.ajax.reload();
                        }
                    });
                }
            });
        });
    });
</script>
@endpush