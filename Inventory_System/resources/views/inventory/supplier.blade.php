@extends('layouts.app')
@section('content')

<div class="container">
    <h2 class="mb-4">Supplier Information</h2>
    <div class="table-responsive">
        <table id="myDataTable" class="table table-bordered table-striped w-100">
            <thead>
                <tr>
                    <th>Supplier Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Contact Person</th>
                    <th>Website</th>
                    <th>TIN</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($rows as $row) --}}
                {{-- @foreach($users as $user) --}}

                    <tr>
                        {{-- <td>{!! $row[0] !!}</td>
                        <td>{!! $row[1] !!}</td>
                        <td>{!! $row[2] !!}</td> --}}
                        <td>DrylTech</td>
                        <td>San Simon</td>
                        <td>dryltech@gmail.com</td>
                        <td>09111111</td>
                        <td>JEt</td>
                        <td>AA.com</td>
                        <td>1111</td>


                        <td>
                            <div class="d-flex gap-2">
                                {{-- <button class="btn btn-sm btn-warning editBtn" data-id="{{ $row[0] }}" data-name="{{ $row[1] }}">
                                    <i class="bi bi-pencil"></i>
                                </button> --}}
                                <button class="btn btn-sm btn-warning editBtn" >
                                    <i class="bi bi-pencil"></i>
                                </button>
                                {{-- <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $row[0] }}">
                                    <i class="bi bi-trash"></i>
                                </button> --}}
                                <button class="btn btn-sm btn-danger deleteBtn">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="inputName" placeholder="Input Name">
                </div>

                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="Input Email">
                </div>

                <div class="mb-3">
                        <label for="userRole" class="form-label">Role</label>
                        <select class="form-select" id="userRole" aria-label="Default select example">
                            <option value="" selected disabled>Choose a role...</option> <!-- Default empty option -->
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add</button>
            </div>
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

<script>
    $(document).ready(function () {
        let domSetup = "<'row'<'col-sm-12 col-md-8'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";

        const A_LENGTH_MENU = [[10, 25, 50, 100, -1], ['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']];

        const TABLE_BUTTONS = [
            {
                text     : '<i class="bi bi-plus-lg"></i> Add',
                className: 'btn btn-success',
                action   : function () {
                    let modal = new bootstrap.Modal(document.getElementById('addModal'));
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

        $('#myDataTable').DataTable({
            dom: domSetup,
            aLengthMenu: A_LENGTH_MENU,
            buttons: TABLE_BUTTONS,
            responsive: true,
            autoWidth: false
        });
    });
</script>
@endsection

