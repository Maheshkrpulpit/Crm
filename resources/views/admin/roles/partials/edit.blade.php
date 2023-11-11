<div id="editRecordModals" class="modal fade show" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden">
            <div class="modal-header p-3">
                <h4 class="card-title mb-0">@lang('Edit Role')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($role, ['route' => ['admin.roles.update', $role->id], 'method' => 'PUT', 'id' => 'updateRecordForm']) !!}
                    @method('PUT')
                    <div class="row">
                        @include('admin.roles.partials.__form')  
                        <div class="text-end">
                            {!! Form::submit(trans('Update'),['class' => 'updateButton btn btn-primary']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>