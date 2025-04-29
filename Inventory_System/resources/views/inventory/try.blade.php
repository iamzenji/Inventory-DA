@extends('layouts.app')
@section('content')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

{{-- Add Employee Modal --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="add_employee_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg"><label>First Name</label><input type="text" name="fname" class="form-control" required></div>
            <div class="col-lg"><label>Last Name</label><input type="text" name="lname" class="form-control" required></div>
          </div>
          <div class="my-2"><label>E-mail</label><input type="email" name="email" class="form-control" required></div>
          <div class="my-2"><label>Phone</label><input type="tel" name="phone" class="form-control" required></div>
          <div class="my-2"><label>Post</label><input type="text" name="post" class="form-control" required></div>
          <div class="my-2"><label>Avatar</label><input type="file" name="avatar" class="form-control" required></div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Edit Employee Modal --}}
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="edit_employee_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <input type="hidden" name="emp_avatar" id="emp_avatar">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg"><label>First Name</label><input type="text" name="fname" id="fname" class="form-control" required></div>
            <div class="col-lg"><label>Last Name</label><input type="text" name="lname" id="lname" class="form-control" required></div>
          </div>
          <div class="my-2"><label>E-mail</label><input type="email" name="email" id="email" class="form-control" required></div>
          <div class="my-2"><label>Phone</label><input type="tel" name="phone" id="phone" class="form-control" required></div>
          <div class="my-2"><label>Post</label><input type="text" name="post" id="post" class="form-control" required></div>
          <div class="my-2"><label>Avatar</label><input type="file" name="avatar" class="form-control"></div>
          <div class="mt-2" id="avatar"></div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Table --}}
<div class="container my-5">

    <h2 class="mb-4">Manage Employees</h2>
    <div class="card-body">
      <table id="employeeTable" class="table table-bordered table-striped w-100">
        <thead>
          <tr>
            <th>ID</th><th>Avatar</th><th>Name</th><th>Email</th><th>Post</th><th>Phone</th><th>Action</th>
          </tr>
        </thead>
        <tbody id="show_all_employees">
          <tr><td colspan="7" class="text-center text-secondary py-5">Loading...</td></tr>
        </tbody>
      </table>
    </div>
 
</div>

{{-- Core JS --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- DataTables + Buttons JS --}}
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
$(function() {
  // Fetch & render employees
  fetchAllEmployees();

  function fetchAllEmployees() {
    $.get("{{ route('fetchAll') }}", {}, function(html) {
      $("#show_all_employees").html(html);
      // initialize DataTable
      $('#employeeTable').DataTable({
        order: [0, 'desc'],
        dom: "<'row'<'col-md-8'B><'col-md-4'f>>" +
             "<'row'<'col-12'tr>>" +
             "<'row'<'col-md-5'i><'col-md-7'p>>",
        aLengthMenu: [[10,25,50,100,-1], ['10 rows','25 rows','50 rows','100 rows','Show all']],
        responsive: true,
        autoWidth: false,
        buttons: [
          {
            text     : '<i class="bi bi-plus-lg"></i> Add',
            className: 'btn btn-success',
            action   : function () {
              new bootstrap.Modal($('#addEmployeeModal')).show();
            }
          },
          { extend: 'copy',  text: '<i class="bi bi-clipboard"></i> Copy',   className: 'btn btn-success' },
          { extend: 'excel', text: '<i class="bi bi-file-earmark-excel"></i> Excel', className: 'btn btn-success' },
          { extend: 'csv',   text: '<i class="bi bi-file-earmark-text"></i> CSV',   className: 'btn btn-success' },
          { extend: 'pdf',   text: '<i class="bi bi-file-earmark-pdf"></i> PDF',   className: 'btn btn-success' },
          { extend: 'print', text: '<i class="bi bi-printer"></i> Print',        className: 'btn btn-success' },
          { extend: 'colvis',text: '<i class="fas fa-columns"></i> Column Visibility', className: 'btn btn-success' }
        ]
      });
    });
  }

  // Your existing AJAX handlers for add/edit/delete go here...
});
</script>
@endsection
