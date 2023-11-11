@extends('layouts.master')
@section('title') @lang('locale.manage_role_and_permissions') @endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />


@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang( 'locale.roles' ) @endslot
@slot('title')@lang( 'locale.manage_roles' ) @endslot
@endcomponent

@component('components.alert',['response'=>session('status')??[]])

@endcomponent



<!--end row-->

@can('roles.view')

<div class="row">
    <div class="col-lg-12">
        <div class="card border-top border-primary" id="invoiceList">
            <div class="card-header border border-dashed ">
                <div class="d-flex align-items-center">
                    <div class="row flex-grow-1 g-3">
                        <div class="col-xxl-11 col-sm-12">
                            <div class="search-box">
                                <input type="text" id="searchTableInput" class="form-control search bg-light border-light" placeholder="Search for role or something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-2 flex-wrap">
                            <button class="btn btn-primary" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                            <a href="{{route('roles.create')}}" class="btn btn-info"><i class="ri-add-line align-bottom me-1"></i> @lang( 'locale.buttons.add' )</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <div class="table-responsive table-card">
                        <table class="table align-middle table-nowrap" id="roles_table">
                            <thead class="text-muted">
                                <tr>
                                    <!--    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th> -->
                                    <th class="sort text-uppercase" data-sort="roles">@lang( 'locale.roles' )</th>
                                    <th class="sort text-uppercase" data-sort="country">@lang( 'locale.action' )</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="invoice-list-data">

                            </tbody>
                        </table>
                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                </lord-icon>
                                <h5 class="mt-2">{{__('no_result')}}</h5>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!--end col-->
</div>


@endcan

@endsection
@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var roles_table = $('#roles_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route("roles.index")}}',
            buttons: [],
            columnDefs: [{
                "targets": 1,
                "orderable": false,
                "searchable": false
            }]
        });

        $(document).on('click', 'button.delete_role_button', function() {
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
            }).then(function(willDelete) {

                if (willDelete.value) {
                    var href = selector.attr('data-href');
                    var data = selector.serialize();


                    $.ajax({
                        type: "DELETE",
                        url: href,
                        dataType: "json",
                        data: {
                            '_token': '{{csrf_token()}}'
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
                                roles_table.ajax.reload();
                            } else {
                                Swal.fire({
                                    html: '<div class="mt-3">' +
                                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon>' +
                                        '<div class="mt-4 pt-2 fs-15">' +
                                        '<h4>' + result.msg + '</h4>' +
                                        '<p class="text-muted mx-4 mb-0">Your email Address is invalid</p>' +
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


        $('#searchTableInput').keyup(function() {
            roles_table.search($(this).val()).draw();
        })
    });
    // table

    // 
</script>

@endsection