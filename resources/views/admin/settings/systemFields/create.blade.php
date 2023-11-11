<div id="addRecordModals" class="modal fade show" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden">
            <div class="modal-header p-3">
                <h4 class="card-title mb-0">{{ lang('Add System Fields') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('settings.system-fields.create'), 'method' => 'post', 'id' => 'addRecordForm']) !!}
                @include('admin.settings.systemFields.partials.__form')
                <div class="text-end">
                    {!! Form::submit(lang('Submit'), ['class' => 'addSubmit btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    $(".formFieldTypes #type").on('change', function() {
        $("#html-data").hide();
        if($.inArray(this.value,[2,3,5])){
            $("#html-data").show();
        }
    });

    $("#add-item").click(function() {
        $("#html-data").append(
            '<div  class="input-group mb-3"><input id="label" class="form-control" required="" placeholder="Field Value 2" name="value[]" type="text"><spam class="btn btn-danger  add-del" >-</spam></div>'
            
        );
    });

    $(document).on("click", ".add-del", function() {
        $(this).parent().remove(); 
    });

    $("html-data").show();
   // $("html-data").hide();
   
  
</script>
