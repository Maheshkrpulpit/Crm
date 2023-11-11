<div id="editRecordModals" class="modal fade show" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden">
            <div class="modal-header p-3">
                <h4 class="card-title mb-0">@lang('Edit User')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($user, ['route' => ['admin.users.update', $user->id],'method'=>'POST','id'=>'updateRecordForm']) !!}
                    @method('PUT')
                    <div class="row">
                        @include('admin.users.partials.__form')  
                        <div class="text-end">
                            {!! Form::submit(trans('Update'),['class' => 'updateButton btn btn-primary']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>