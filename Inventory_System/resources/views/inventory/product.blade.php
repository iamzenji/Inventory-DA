@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="mb-4">Products</h2>
    <div class="table-responsive">
        <table id="myDataTable" class="table table-bordered table-striped w-100">
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be dynamically populated using AJAX -->
            </tbody>
        </table>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addProductForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <div class="my-2">
                        <label for="product_type">Product Type</label>
                        <input type="text" name="product_type" id="product_type" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="product_number">Product Number</label>
                        <input type="text" name="product_number" id="product_number" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="serial_number">Serial Number</label>
                        <input type="text" name="serial_number" id="serial_number" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="date_acquired">Date Acquired</label>
                        <input type="date" name="date_acquired" id="date_acquired" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="office_location">Office Location</label>
                        <input type="text" name="office_location" id="office_location" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="issued_to">Issued To</label>
                        <input type="text" name="issued_to" id="issued_to" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="end_user">End User</label>
                        <input type="text" name="end_user" id="end_user" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addProductBtn">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include necessary scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jszip@3.10.1/dist/jszip.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        const table = $('#myDataTable').DataTable({
            dom: "<'row'<'col-sm-12 col-md-8'B><'col-sm-12 col-md-4'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    text: '<i class="bi bi-plus-lg"></i> Add',
                    className: 'btn btn-success',
                    action: function () {
                        let modal = new bootstrap.Modal(document.getElementById('addModal'));
                        modal.show();
                    }
                },
                'copy', 'excel', 'csv', 'pdf', 'print', 'colvis'
            ],
            responsive: true,
            autoWidth: false
        });

        // Add new product (AJAX)
        $('#addProductForm').submit(function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            $('#addProductBtn').text('Adding...');

            $.ajax({
                url: '{{ route('products.store') }}',  // Your route to store data
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status === 200) {
                        Swal.fire('Added!', 'Product added successfully!', 'success');
                        table.ajax.reload();  // Reload the table data
                    }
                    $('#addProductBtn').text('Add Product');
                    $('#addProductForm')[0].reset();
                    $('#addModal').modal('hide');
                }
            });
        });
    });
</script>
@endsection
