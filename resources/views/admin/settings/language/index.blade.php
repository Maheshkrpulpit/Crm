@extends('layouts.master')
@section('title')
    {{ lang('Manage Languages') }}
@endsection
@section('css')
    <!--datatable css -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ lang('Manage Languages') }}
        @endslot
        @slot('title')
            {{ lang('Language List') }}
        @endslot
    @endcomponent

    @component('components.alert', ['response' => session('status') ?? []])
    @endcomponent


    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="invoiceList">
                <div class="card-header bg-soft-light border border-dashed border-start-0 border-end-0">
                    <div class="d-flex align-items-center">
                        <div class=" mb-0 flex-grow-1">
                            <div class="row flex-grow-1 g-3">
                                <div class="col-xxl-11 col-sm-12">
                                    <div class="search-box">
                                        <input type="text" id="searchTableInput"
                                            class="form-control search bg-light border-light"
                                            placeholder="Search for language or something...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex gap-2 flex-wrap">
                                {{-- <button class="btn btn-primary" id="remove-actions" onClick="deleteMultiple()"><i
                                        class="ri-delete-bin-2-line"></i></button>
                                <a href="{{ route('settings.language.create') }}" class="btn btn-info"><i
                                        class="ri-add-line align-bottom me-1"></i> {{ lang('add') }}</a> --}}
                                <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal"
                                    id="create-btn" data-bs-target="#showlanModal"><i
                                        class="ri-add-line align-bottom me-1"></i>{{ lang('Add') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card">
                            <table class="table align-middle table-nowrap" id="language_table">
                                <thead class="text-muted">
                                    <tr>
                                        <!--    <th scope="col" style="width: 50px;">
                                                           <div class="form-check">
                                                               <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                           </div>
                                                       </th> -->
                                        <th class="sort text-uppercase" data-sort="invoice_id">{{ lang('Name') }}</th>
                                        <th class="sort text-uppercase" data-sort="customer_name">
                                            {{ lang('Code') }}</th>
                                        <th class="sort text-uppercase" data-sort="customer_name">{{ lang('Icon') }}</th>
                                        <th class="sort text-uppercase" data-sort="email">{{ lang('Status') }}</th>
                                        <th class="sort text-uppercase" data-sort="country">{{ lang('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all" id="invoice-list-data">

                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->
    <!--end row-->

    <!-- modal-->

    <div class="modal fade" id="showlanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Add Language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                {!! Form::open([
                    'url' => route('settings.language.store'),
                    'method' => 'post',
                    'id' => 'hhj',
                    'novalidate',
                    'class' => 'needs-validation',
                ]) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">

                                {!! Form::label('name', lang('Name') . ':*') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => lang('Name')]) !!}

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">

                                {!! Form::label('code', lang('Code') . ':*') !!}
                                {!! Form::text('code', null, ['class' => 'form-control', 'required', 'placeholder' => lang('Code')]) !!}

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">                              
                                    {!! Form::label('file', lang('Image Upload') . ':*') !!}
                                    {!! Form::file('file', ['class' => 'form-control', 'id'=>'inputGroupFile01',  'required']) !!}    
                                                                                         

                            </div>
                        </div>

                        <!-- Default File Input Example -->


                        <div class="col-lg-12">
                            <div class="mb-3">


                                <div class="form-check form-switch form-switch-lg" dir="ltr">

                                    <input type="checkbox" class="form-check-input" name="status" id="customSwitchsizelg"
                                        value="1">
                                    <label class="form-check-label" for="customSwitchsizelg">{{ lang('Status') }}</label>

                                </div>

                            </div>
                        </div>

                        <!--end col-->


                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-primary">{{ lang('Save') }}</button>
                                {{-- <button type="end" class="btn btn-soft-success">{{ lang('Cancel') }}</button> --}}
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!--end modal-->
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <!-- form wizard init -->
    <script src="assets/js/pages/form-wizard.init.js"></script>



    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <!-- prismjs plugin -->
    <script src="{{ URL::asset('assets/libs/prismjs/prism.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var language_table = $('#language_table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: '{{ route('settings.language.index') }}',
                columnDefs: [{
                    "targets": [3],
                    "orderable": false,
                    "searchable": true
                }],
                "columns": [{
                        "data": "name"
                    },

                    {
                        "data": "code"
                    },
                    {
                        "data": "file"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "action"
                    }
                ]
            });

            $('#searchTableInput').keyup(function() {
                language_table.search($(this).val()).draw();
            })
            $(document).on('click', 'button.delete_language_button', function() {
                var selector = $(this);
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                    cancelButtonClass: 'btn btn-danger w-xs mt-2',
                    confirmButtonText: "Yes, delete it!",
                    buttonsStyling: false,
                    showCloseButton: true
                }).then((willDelete) => {
                    if (willDelete.value) {
                        var href = selector.attr('data-href');
                        var data = selector.serialize();


                        $.ajax({
                            type: "DELETE",
                            url: href,
                            dataType: "json",
                            data: {
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(result) {
                                if (result.success == true) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: result.msg,
                                        icon: 'success',
                                        confirmButtonClass: 'btn btn-primary w-xs mt-2',
                                        buttonsStyling: false
                                    })
                                    language_table.ajax.reload();
                                } else {
                                    Swal.fire({
                                        html: '<div class="mt-3">' +
                                            '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon>' +
                                            '<div class="mt-4 pt-2 fs-15">' +
                                            '<h4>' + result.msg + '</h4>' +
                                            '<p class="text-muted mx-4 mb-0">' +
                                            result.msg + '</p>' +
                                            '</div>' +
                                            '</div>',
                                        showCancelButton: true,
                                        showConfirmButton: false,
                                        cancelButtonClass: 'btn btn-primary w-xs mb-1',
                                        cancelButtonText: 'Dismiss',
                                        buttonsStyling: false,
                                        showCloseButton: true
                                    })
                                }
                            }
                        });


                    }
                });
            });

        });

        function updateStatus(selector) {
            var row_id = $(selector).val();

            $.get('{{ url('settings/language/update/status') }}' + '/' + row_id, function(res) {
                if (res.status) {
                    showSmallMessage(res.message, res.type);

                } else {
                    showSmallMessage(res.message, res.type);


                    if ($(selector).prop('checked') == true) {
                        $(selector).parent('div').replaceWith(
                            '<div class="form-check form-switch form-switch-custom form-switch-success"><input onchange="updateStatus(this)" class="form-check-input" type="checkbox" role="switch" id="SwitchCheck11' +
                            row_id + '" value="' + row_id +
                            '"><label class="form-check-label" for="SwitchCheck11' + row_id + '"></label></div>'
                        )
                    } else {
                        $(selector).parent('div').replaceWith(
                            '<div class="form-check form-switch form-switch-custom form-switch-success"><input onchange="updateStatus(this)" class="form-check-input" type="checkbox" role="switch" id="SwitchCheck11' +
                            row_id + '" checked value="' + row_id +
                            '"><label class="form-check-label" for="SwitchCheck11' + row_id + '"></label></div>'
                        )

                    }
                }

            })
        }
    </script>
@endsection
