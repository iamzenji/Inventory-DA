@extends('layouts.app')

@section('title', 'Departments')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Department List</h2>

    <table id="departmentTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Department Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Add Department Modal -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addDepartmentForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="departmentNameInput">Department Name</label>
                        <input type="text" class="form-control" name="name" id="departmentNameInput" placeholder="Enter department name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Department Modal -->
<div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editDepartmentForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="editDepartmentId">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editDepartmentNameInput">Department Name</label>
                        <input type="text" class="form-control" name="name" id="editDepartmentNameInput" placeholder="Edit department name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    let dataTable;

    function fetchDepartments() {
        $.get("{{ route('departments.index') }}", function (data) {
            const table = $('#departmentTable');

            if ($.fn.DataTable.isDataTable(table)) {
                table.DataTable().clear().destroy();
            }

            let rows = '';
            data.forEach(dept => {
                rows += `
                    <tr>
                        <td>${dept.name}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-warning editBtn" data-id="${dept.id}" data-name="${dept.name}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtn" data-id="${dept.id}">
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
                            $('#addDepartmentForm')[0].reset();
                            $('#addDepartmentModal').modal('show');
                        }
                    },
                    'copy', 'excel', 'csv', 'pdf', 'print', 'colvis'
                ]
            });
        });
    }

    fetchDepartments();

    $('#addDepartmentForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('departments.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $('#addDepartmentModal').modal('hide');
                fetchDepartments();
                $('#addDepartmentForm')[0].reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Department added successfully.'
                });
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let msg = Object.values(errors).flat().join('\n');
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: msg.replace(/\n/g, '<br>')
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message || 'Failed to add department.'
                    });
                }
            }
        });
    });

    $(document).on('click', '.editBtn', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        $('#editDepartmentId').val(id);
        $('#editDepartmentNameInput').val(name);
        $('#editDepartmentModal').modal('show');
    });

    $('#editDepartmentForm').submit(function (e) {
        e.preventDefault();
        const id = $('#editDepartmentId').val();
        $.ajax({
            url: `/departments/${id}`,
            method: 'POST',
            data: {
                _method: 'PUT',
                _token: '{{ csrf_token() }}',
                name: $('#editDepartmentNameInput').val()
            },
            success: function () {
                $('#editDepartmentModal').modal('hide');
                fetchDepartments();
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'Department updated successfully.'
                });
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let msg = Object.values(errors).flat().join('\n');
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: msg.replace(/\n/g, '<br>')
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message || 'Failed to update department.'
                    });
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
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/departments/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        fetchDepartments();
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Department has been deleted.'
                        });
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to delete department.'
                        });
                    }
                });
            }
        });
    });
});
</script>
@endpush
