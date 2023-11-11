<div id="editRecordModals" class="modal fade show" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden">
            <div class="modal-header p-3">
                <h4 class="card-title mb-0">@lang('locale.buttons.edit') @lang('locale.master.academic_years.title_singular')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($systemField, ['route' => ['settings.system-fields.update', $systemField->id],'method'=>'POST','id'=>'updateRecordForm']) !!}
                    @method('PUT')
                    @include('admin.settings.systemFields.partials.__form')  
                    <div class="text-end">
                        {!! Form::submit(trans('locale.buttons.update'),['class' => 'updateButton btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>