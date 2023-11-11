<div class="card-header bg-gradient bg-light border border-dashed border-end-0 border-start-0">
    <div class="row g-6">
        <div class="col-md-3">
            {!! Form::select('user_id', $user_data, null, [
                'class' => 'form-control',
                'id' => 'user_id',
                'placeholder' => lang('Select User'),
            ]) !!}
        </div>
        <div class="col-md-3">
            {!! Form::select('brand_id', $brand_data, null, [
                'class' => 'form-control',
                'id' => 'brand_id',
                'placeholder' => lang('Select Brand'),
            ]) !!}
        </div>
        <div class="col-md-3">
            {!! Form::date('date', old('date', null), ['class' => 'form-control', 'id' => 'date']) !!}
        </div>
        <div class="col-md-3">
            <div class="search-box">
                {!! Form::text('search', '', [
                    'id' => 'searchTable',
                    'class' => 'form-control search',
                    'placeholder' => lang('Search Sales...'),
                ]) !!}
                <i class="ri-search-line search-icon"></i>
            </div>
        </div>
    </div>
    <!--end row-->
</div>

@section('script-bottom')
    <script>
        $(document).ready(function() {
            var dataTable = $('#ajaxData_table').DataTable();

            $('#user_id').on('change', function() {
                var selectedUser = $('#user_id').val();
                dataTable.column(3).search(selectedUser).draw();
            });

            $('#brand_id').on('change', function() {
                var selectedBrand = $('#brand_id').val();
                dataTable.column(2).search(selectedBrand).draw();
            });

            $('#date').on('change', function() {
                var selectedDate = $('#date').val();
                dataTable.column(9).search(selectedDate).draw();
            });

            $(document).on('keyup', '#searchTable', function(e) {
                var searchValue = $('#searchTable').val();
                dataTable.search(searchValue).draw();
            });

            // Event listener for the reset button
            $(document).on('click', '.resetButton', function(e) {
                $('#user_id, #brand_id, #date, #searchTable').val('');
                dataTable.search('').columns().search('').draw();
            });
        });
    </script>
@endsection
