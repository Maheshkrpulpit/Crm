<div class="card-body border border-dashed border-end-0 border-start-0">
    <div class="row g-6">
        <div class="col-xxl-2 col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
            {!! Form::select('roles', $roles,null, ['class' => 'form-control','id' => 'roleSelect', 'placeholder' => trans('Select role')]) !!}
        </div>
        <div class="col-xxl-2 col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
            {!! Form::select('status',$status, null, ['class' => 'form-control','id' => 'statusSelect', 'placeholder' => trans('Select status')]) !!}
        </div>
        <div class="col-xxl-6 col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
            <div class="search-box">
                {!! Form::text('search','', ['id'=>'searchTable','class' => 'form-control search bg-light border-light', 'placeholder' => trans('Searching...')]) !!}
                <i class="ri-search-line search-icon"></i>
            </div>
        </div>

        <!--end col-->
        <div class="col-xxl-1 col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
            {!! Form::button('<i class="ri-search-line align-bottom"></i>', ['type' => 'button', 'class' => 'btn btn-primary searchData me-2'] )  !!}

            {!! Form::button('<i class="ri-close-fill align-bottom"></i>', ['type' => 'button', 'class' => 'btn btn-warning resetButton'] )  !!}
        </div>
        <!--end col-->
    </div>
    <!--end row-->
</div>

@section('script-bottom')
    <script type="text/javascript">
        $(document).on('click','.searchData', function(e){
            var dataTable = $('#ajaxData_table').DataTable();

            // Apply status filters based on the selected values
            var selectedStatus = $('#statusSelect').val();
            if (selectedStatus) {
                dataTable.column('status:name').search(selectedStatus);
            }

            // Apply status filters based on the selected values
            var selectedRole = $('#roleSelect').val();
            if (selectedRole) {
                dataTable.column('roles.name:name').search(selectedRole);
            }

            // Apply status filters based on the selected values
            var searchTerm = $('#searchTable').val();
            if (searchTerm) {
                dataTable.search(searchTerm);
            }

            // Redraw the DataTable with the applied filters
            dataTable.draw();
        });

        // Event listener for the reset button
        $(document).on('click','.resetButton', function(e){
            // Clear the select box selections and input field value
            $('#statusSelect').val('');
            $('#roleSelect').val('');
            $('#searchTable').val('');

            // Trigger the custom search with empty values to reset the DataTable
            $('#ajaxData_table').DataTable().search('').column('').columns().search('').draw();
        });
    </script>
@endsection