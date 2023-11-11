<div id="row">
    <div class="row">
                {!! Form::hidden('user_id[]', $user_id ?? (isset($asignBrand) ? $asignBrand->user_id : ''), ['class' => 'form-control', 'required' => true, 'placeholder' => trans('Select User....')]) !!}  
        <div class="col-lg-4">
            <div class="mb-3">
                {!! Form::label('brand_id', trans('Brand'), array('class' => 'form-label')); !!}
                {!! Form::select ('brand_id[]', $brand , isset($asignBrand)? $asignBrand->brand_id :' ', ['id'=>'brand_id','class' => 'form-control','required' =>true, 'placeholder' => trans('Select Brand')]) !!}  
            </div>
        </div>
        <div class="col-lg-2">
            <div class="mb-2">
                {!! Form::label('comission', trans('Comission'), ['class' => 'form-label']) !!}
            </div>
            <div class="mb-3 mx-4">
                {!! Form::checkbox('comission[]', 1, old('comission', isset($asignBrand) && $asignBrand->comission ? true : false), [ 'id'=>'comission','class' => 'form-check-input',]) !!}
            </div>
        </div>
        <div class="col-lg-4" id="amountField" style="display: none;">
            <div class="mb-3">
                {!! Form::label('amount', trans('Amount'), ['class' => 'form-label']) !!}
                {!! Form::number('amount[]', old('amount', null), ['id' => 'amount', 'class' => 'form-control', 'placeholder' => trans('Enter Amount')]) !!}  
            </div>
        </div>
        <div class="col-lg-2 mt-4 text-end">
            <div class="mb-3">
                <button id="rowAdder" type="button" class="btn btn-info">
                    <span class="bi bi-plus-square-dotted"></span> ADD
                </button>
            </div>
        </div>
        
    </div>
</div>
        <div id="newinput" class="row"></div>


<script type="text/javascript">
    $("#rowAdder").click(function () {
        newRowAdd = '<div class="row">' +
            '<div>' +
            '<div>{!! Form::hidden('user_id[]', $user_id ?? (isset($asignBrand) ? $asignBrand->user_id : ''), ['class' => 'form-control', 'required' => true, 'placeholder' => trans('Select User....')]) !!}</div>' +
            '</div>' +
            '<div class="col-lg-4">' +
            '<div class="mb-3">{!! Form::label('brand_id', trans('Brand'), array('class' => 'form-label')); !!}{!! Form::select ('brand_id[]', $brand , isset($asignBrand)? $asignBrand->brand_id :' ', ['id'=>'brand_id','class' => 'form-control','required' =>true, 'placeholder' => trans('Select Brand')]) !!}</div>' +
            '</div>' +
            '<div class="col-lg-2">' +
            '<div class="mb-2">{!! Form::label('comission', trans('Comission'), ['class' => 'form-label']) !!}</div>'+
            '<div class="mb-2 mx-4">{!! Form::checkbox('comission[]', 1, old('comission', isset($asignBrand) && $asignBrand->comission ? true : false), [ 'id'=>'comission','class' => 'form-check-input',]) !!}</div>' +
            '</div>' +
            '<div class="col-lg-4" id="amountField" style="display: none;">' +
            '<div class="mb-3">{!! Form::label('amount', trans('Amount'), array('class' => 'form-label')); !!}{!! Form::number('amount[]',old('amount',null), ['id'=>'amount','class' => 'form-control','placeholder' => trans('Enter Amount')]) !!}</div>' +
            '</div>' +
            '<div class="col-lg-1 mt-4 text-end">' +
            '<div class="pt-2">' +
            '<button id="DeleteRow" type="button" class="btn btn-sm btn-danger remove-item-btn delete_role_button"><i class="ri-delete-bin-line"></i></button>' +
            '</div>' +
            '</div>' +
            '</div>';

        $('#newinput').append(newRowAdd);
        $('#newinput').find('input[type="checkbox"]').last().change(function() {
            var amountField = $(this).closest('.row').find('#amountField');
            if (this.checked) {
                amountField.show();
            } else {
                amountField.hide();
            }
        });
    });

    $("body").on("click", "#DeleteRow", function () {
        $(this).closest(".row").remove();
    });
$(document).ready(function() {
        function toggleAmountField() {
        if ($('#comission').is(':checked')) {
            $('#amountField').show();
        } else {
            $('#amountField').hide();
        }
    }
        // Initial check and setup
        toggleAmountField();
        // Listen for changes to the "comission" checkbox
        $('#comission').change(toggleAmountField);
    });

   

</script>

