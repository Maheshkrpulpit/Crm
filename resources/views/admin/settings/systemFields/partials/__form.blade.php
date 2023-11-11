@if(!$editing)
<div class="mb-3">
    {!! Form::label('name', lang('Field Name'), array('class' => 'form-label')); !!}
    {!! Form::text('name',old('name',null), ['id'=>'name','class' => 'form-control','required' =>true, 'placeholder' => lang('Field Name')]) !!}
</div>
@endif
<div class="mb-3">
    {!! Form::label('label', lang('Field Label'), array('class' => 'form-label')); !!}
    {!! Form::text('label',old('label',null), ['id'=>'label','class' => 'form-control','required' =>true, 'placeholder' =>  lang('Field Label') ]) !!}
</div>
<div class="mb-3">
    {!! Form::label('order', lang('Order'), array('class' => 'form-label')); !!}
    {!! Form::number('order',old('order',null), ['id'=>'order','class' => 'form-control','required' =>true, 'placeholder' =>  lang('Field Order') ]) !!}
</div>
@if(!$editing)
<div class="mb-3 formFieldTypes">
    {!! Form::label('type', lang('Field Type'), array('class' => 'form-label')); !!}
    {!! Form::select('type', $fieldType , isset($systemField)? $systemField->type :' ', ['id'=>'type','class' => 'form-control','required' =>true, 'placeholder' => lang('Field Type')]) !!}
</div>
@endif
<div class="mb-3 formFieldTypes">
    {!! Form::label('grid', lang('Grid (Bootstrap Column)'), ['class' => 'form-label']) !!}
    {!! Form::select('grid', [
        'col-md-1' => 'col-md-1',
        'col-md-2' => 'col-md-2',
        'col-md-3' => 'col-md-3',
        'col-md-4' => 'col-md-4',
        'col-md-5' => 'col-md-5',
        'col-md-6' => 'col-md-6',
        'col-md-7' => 'col-md-7',
        'col-md-8' => 'col-md-8',
        'col-md-9' => 'col-md-9',
        'col-md-10' => 'col-md-10',
        'col-md-11' => 'col-md-11',
        'col-md-12' => 'col-md-12',
        ], old('grid', 'col-md-3'), ['id' => 'grid', 'class' => 'form-control', 'required' => true, 'placeholder' => lang('Select Column Size')]) !!}
</div>
@if(!$editing)
<div id='html-data' style="display:none">
    <div class="input-group mb-3">
        {!! Form::text('value[]',old('label'), ['class' => 'form-control','aria-label'=>'Recipients username',  'aria-describedby'=> 'basic-addon2', 'required' =>true, 'placeholder' =>  lang('Value 1') ]) !!}
        <div class="text-end mt-" >
        {!! Form::button(lang('+'),['id' => 'add-item','class' => 'addSubmit btn btn-primary']) !!}</div>    
    </div>
</div>
@endif
<div class="mb-3">
    {!! Form::label('show_on_table', trans('Show On Table'), ['class' => 'form-label']) !!}
    {!! Form::checkbox('show_on_table', 1, old('show_on_table', isset($systemField) && $systemField->show_on_table ? true : false), [ 'id'=>'show_on_table','class' => 'form-check-input',]) !!}
</div>


<div class="mb-3">
    <div class="form-check form-switch form-switch-lg" dir="ltr">
        {!! Form::label('customSwitchsizelg', lang('Status'), array('class' => 'form-check-label')); !!}
        {!! Form::checkbox('status',true,old('status',isset($systemField) && $systemField->status ?  true : false),['id'=>'customSwitchsizelg','class' => 'form-check-input']) !!}
    </div>
</div>

