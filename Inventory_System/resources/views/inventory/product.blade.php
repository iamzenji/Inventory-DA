@extends('layouts.app')

@section('content')
    {{-- DISPLAY DATA --}}
    <div class="container">
        {{-- Breadcrumb Navigation --}}
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <h2 class="fw-bold text-success">Registered Products</h2>
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
            <table id="products-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Type</th>
                        <th>Product Number</th>
                        <th>Serial Number</th>
                        <th>Brand</th>
                        <th>Date Acquired</th>
                        <th>Price</th>
                        <th>Office Location</th>
                        <th>Issued To</th>
                        <th>End User</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- ADD PRODUCT MODAL --}}
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Create Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createProductForm">
                        @csrf
                        <div class="mb-3">
                            <label for="product_type" class="form-label">Product Type</label>
                            <input type="text" class="form-control" id="product_type" name="product_type" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_number" class="form-label">Product Number</label>
                            <input type="text" class="form-control" id="product_number" name="product_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="serial_number" class="form-label">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_acquired" class="form-label">Date Acquired</label>
                            <input type="date" class="form-control" id="date_acquired" name="date_acquired" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="office_location" class="form-label">Office Location</label>
                            <input type="text" class="form-control" id="office_location" name="office_location" required>
                        </div>
                        <div class="mb-3">
                            <label for="issued_to" class="form-label">Issued To</label>
                            <input type="text" class="form-control" id="issued_to" name="issued_to" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_user" class="form-label">End User</label>
                            <input type="text" class="form-control" id="end_user" name="end_user" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT PRODUCT MODAL -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editProductForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edit-product-id">

                        <div class="mb-3">
                            <label for="edit-product-type" class="form-label">Product Type</label>
                            <input type="text" class="form-control" id="edit-product-type" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-product-number" class="form-label">Product Number</label>
                            <input type="text" class="form-control" id="edit-product-number" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-serial-number" class="form-label">Serial Number</label>
                            <input type="text" class="form-control" id="edit-serial-number" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="edit-brand" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-date-acquired" class="form-label">Date Acquired</label>
                            <input type="date" class="form-control" id="edit-date-acquired" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="edit-price" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-office-location" class="form-label">Office Location</label>
                            <input type="text" class="form-control" id="edit-office-location" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-issued-to" class="form-label">Issued To</label>
                            <input type="text" class="form-control" id="edit-issued-to" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-end-user" class="form-label">End User</label>
                            <input type="text" class="form-control" id="edit-end-user" required>
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
        let table = $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/products/data",  // Adjust the URL for your products endpoint
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    text: '<i class="bi bi-plus-lg"></i> Add',
                    className: 'btn btn-success',
                    action: function (e, dt, node, config) {
                        $('#addProductModal').modal('show');
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
                { data: 'id', name: 'id' },
                { data: 'product_type', name: 'product_type' },
                { data: 'product_number', name: 'product_number' },
                { data: 'serial_number', name: 'serial_number' },
                { data: 'brand', name: 'brand' },
                { data: 'date_acquired', name: 'date_acquired' },
                { data: 'price', name: 'price' },
                { data: 'office_location', name: 'office_location' },
                { data: 'issued_to', name: 'issued_to' },
                { data: 'end_user', name: 'end_user' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                            <button class="btn btn-warning btn-sm edit-product"
                                    data-id="${row.id}"
                                    data-product_type="${row.product_type}"
                                    data-product_number="${row.product_number}"
                                    data-serial_number="${row.serial_number}"
                                    data-brand="${row.brand}"
                                    data-date_acquired="${row.date_acquired}"
                                    data-price="${row.price}"
                                    data-office_location="${row.office_location}"
                                    data-issued_to="${row.issued_to}"
                                    data-end_user="${row.end_user}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editProductModal">
                                    <i class="fas fa-pencil-alt"></i>
                            </button>

                            <button class="btn btn-danger btn-sm delete-product"
                                    data-id="${row.id}">
                                <i class="bi bi-trash"></i>
                            </button>
                        `;
                    }
                }
            ]
        });

        // Create Product Form Submission
        $('#createProductForm').on('submit', function (e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: "{{ route('products.store') }}",
                data: formData,
                success: function (response) {
                    Swal.fire('Success!', response.success, 'success');
                    $('#addProductModal').modal('hide');
                    $('#createProductForm')[0].reset();
                    $('#products-table').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = Object.values(errors).join('<br>');
                    Swal.fire('Error!', errorMessage, 'error');
                }
            });
        });

        // Open Edit Product Modal
        $(document).on('click', '.edit-product', function() {
            let productId = $(this).data('id');
            let productType = $(this).data('product_type');
            let productNumber = $(this).data('product_number');
            let serialNumber = $(this).data('serial_number');
            let brand = $(this).data('brand');
            let dateAcquired = $(this).data('date_acquired');
            let price = $(this).data('price');
            let officeLocation = $(this).data('office_location');
            let issuedTo = $(this).data('issued_to');
            let endUser = $(this).data('end_user');

            $('#edit-product-id').val(productId);
            $('#edit-product-type').val(productType);
            $('#edit-product-number').val(productNumber);
            $('#edit-serial-number').val(serialNumber);
            $('#edit-brand').val(brand);
            $('#edit-date-acquired').val(dateAcquired);
            $('#edit-price').val(price);
            $('#edit-office-location').val(officeLocation);
            $('#edit-issued-to').val(issuedTo);
            $('#edit-end-user').val(endUser);
        });

        // Handle Update Form Submission
        $('#editProductForm').submit(function(event) {
            event.preventDefault();

            let productId = $('#edit-product-id').val();
            let productType = $('#edit-product-type').val();
            let productNumber = $('#edit-product-number').val();
            let serialNumber = $('#edit-serial-number').val();
            let brand = $('#edit-brand').val();
            let dateAcquired = $('#edit-date-acquired').val();
            let price = $('#edit-price').val();
            let officeLocation = $('#edit-office-location').val();
            let issuedTo = $('#edit-issued-to').val();
            let endUser = $('#edit-end-user').val();

            $.ajax({
                url: '{{ url("products/update") }}/' + productId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_type: productType,
                    product_number: productNumber,
                    serial_number: serialNumber,
                    brand: brand,
                    date_acquired: dateAcquired,
                    price: price,
                    office_location: officeLocation,
                    issued_to: issuedTo,
                    end_user: endUser
                },
                success: function(response) {
                    Swal.fire('Success!', response.success, 'success');
                    $('#editProductModal').modal('hide');
                    $('#products-table').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON.message, 'error');
                }
            });
        });
    });
</script>
@endpush
