@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="mb-4">Product</h2>
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
                    <tr>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_type }}</td>
                            <td>{{ $product->product_number }}</td>
                            <td>{{ $product->serial_number }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->date_acquired }}</td>
                            <td>{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->office_location }}</td>
                            <td>{{ $product->issued_to }}</td>
                            <td>{{ $product->end_user }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-warning editBtn">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtn">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="add_employee_form" action="{{ route('product-names.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">

          <div class="my-2">
            <label>Product Type</label>
            <input type="text" name="product_type" class="form-control" required>
          </div>

          <div class="my-2">
            <label>Product Number</label>
            <input type="text" name="product_number" class="form-control" required>
          </div>

          <div class="my-2">
            <label>Serial Number</label>
            <input type="text" name="serial_number" class="form-control" required>
          </div>

          <div class="my-2">
            <label>Brand</label>
            <input type="text" name="brand" class="form-control" required>
          </div>

          <div class="my-2">
            <label>Date Acquired</label>
            <input type="date" name="date_acquired" class="form-control" required>
          </div>

          <div class="my-2">
            <label>Price</label>
            <input type="text" name="price" class="form-control" required>
          </div>

          <div class="my-2">
            <label>Office Location</label>
            <input type="text" name="office_location" class="form-control" required>
          </div>

          <div class="my-2">
            <label>Issued To</label>
            <input type="text" name="issued_to" class="form-control" required>
          </div>

          <div class="my-2">
            <label>End User</label>
            <input type="text" name="end_user" class="form-control" required>
          </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Product</button>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- Include scripts only once -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
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
<script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
<script>
  
    $(document).ready(function () {
        let domSetup =  "<'row'<'col-sm-12 col-md-8'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";

        const A_LENGTH_MENU = [[10, 25, 50, 100, -1], ['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']];

        const TABLE_BUTTONS = [
            {
                text     : '<i class="bi bi-plus-lg"></i> Add',
                className: 'btn btn-success',
                action   : function () {
                    let modal = new bootstrap.Modal(document.getElementById('addProduct'));
                    modal.show();
                }
            },
            {
                extend   : 'copy',
                text     : '<i class="bi bi-clipboard"></i> Copy',
                className: 'btn btn-success'
            },
            {
                extend   : 'excel',
                text     : '<i class="bi bi-file-earmark-excel"></i> Excel',
                className: 'btn btn-success'
            },
            {
                extend   : 'csv',
                text     : '<i class="bi bi-file-earmark-text"></i> CSV',
                className: 'btn btn-success'
            },
            {
                extend   : 'pdf',
                text     : '<i class="bi bi-file-earmark-pdf"></i> PDF',
                className: 'btn btn-success'
            },
            {
                extend   : 'print',
                text     : '<i class="bi bi-printer"></i> Print',
                className: 'btn btn-success'
            },
            {
                extend   : 'colvis',
                text     : '<i class="fas fa-columns"></i> Column Visibility',
                className: 'btn btn-success'
            }
        ];
        // let table = new DataTable('#myTable');
        $('#myDataTable').DataTable({
            dom: domSetup,
            // aLengthMenu: A_LENGTH_MENU,
            buttons: TABLE_BUTTONS,
            responsive: true,
            autoWidth: false
        });
    });

@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: '{{ session("success") }}',
    confirmButtonColor: '#198754'
});
@endif


$(document).ready(function () {
  $('#add_employee_form').on('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    let formData = new FormData(this);

    $.ajax({
      url: $(this).attr('action'),
      method: $(this).attr('method'),
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        // Optional: reset form or hide modal
        $('#add_employee_form')[0].reset();
        $('.modal').modal('hide');

        // Do something with the response
        console.log('Product added:', response);

        // Example: append the new product to a table
        // $('#product_table').append(`<tr><td>${response.product_type}</td><td>${response.product_number}</td></tr>`);
      },
      error: function (xhr) {
        console.log('Error:', xhr.responseText);
        alert('Something went wrong. Please check the form.');
      }
    });
  });
});



</script>
@endsection