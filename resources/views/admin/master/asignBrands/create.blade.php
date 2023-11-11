
<div class="modal fade show" id="addRecordModals" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h4 class="card-title mb-0">{{lang('Add Asign Brands')}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' =>route('admin.asign-brands.create'),'method'=>'post','id'=>'addRecordForm']) !!}
                @include('admin.master.asignBrands.partials.__form')  
                <div class="text-end">
                    {!! Form::submit(trans('Submit'),['class' => 'addSubmit btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- Modal -->












               