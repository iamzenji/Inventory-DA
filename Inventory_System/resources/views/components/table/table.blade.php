{{-- <x-modal.modal id="addProductModal" title="Add Product"> --}}
<div class="table-responsive">
    <table id="{{ $id ?? 'datatable' }}" class="table table-bordered table-striped w-100">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@once
    @push('scripts')
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

    @endpush
@endonce

@push('scripts')
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
                    let modal = new bootstrap.Modal(document.getElementById('addProductModal'));
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

        $('#{{ $id ?? "datatable" }}').DataTable({
            dom         : domSetup,
            aLengthMenu : A_LENGTH_MENU,
            buttons     : TABLE_BUTTONS,
            responsive  : true,
            autoWidth   : false
        });
    });
</script>
@endpush
